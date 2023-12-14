<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model implements HasMedia
{
    use HasFactory,
        HasSlug,
        InteractsWithMedia,
        NodeTrait;

    protected $guarded = ['id'];

    protected $casts = [
        'breadcrumbs' => 'array',
    ];

    public function products(): HasMany|Product
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent(): BelongsTo|Category
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function rootCategory(): BelongsTo|Category
    {
        return $this->belongsTo(Category::class, 'root_category_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function generatePath(): static
    {
        $slug = $this->slug;

        $this->path = $this->isRoot()
            ? $slug
            : $this->parent->path . '/' . $slug;

        $breadcrumb = ['name' => $this->name, 'path' => $this->path];

        if ($this->isRoot()) {
            $this->breadcrumbs = [$breadcrumb];
            $this->root_category_id = $this->id;
        } else {
            $this->root_category_id = $this->parent->root_category_id;
            $tempBreadcrumbs = $this->parent->breadcrumbs;
            $tempBreadcrumbs[] = $breadcrumb;
            $this->breadcrumbs = $tempBreadcrumbs;
        }

        return $this;
    }

    public function updateDescendantsPaths(): void
    {
        $descendants = $this->descendants()->defaultOrder()->get();
        $descendants->push($this)->linkNodes()->pop();

        foreach ($descendants as $model) {
            $model->generatePath()->save();
        }
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->useFallbackUrl('/img/categories/placeholder.svg')
            ->useFallbackPath(public_path('/img/categories/placeholder.svg'));
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Category $category) {
            $category->generatePath();
        });

        static::created(function (Category $category) {
            $category->root_category_id = $category->isRoot()
                ? $category->id
                : $category->parent->root_category_id;

            $category->save();
        });

        static::saving(function (Category $category) {
            if ($category->isDirty('name', 'slug', 'parent_id')) {
                $category->generatePath();
            }
        });

        static::saved(function (Category $category) {
            static $updating = false;

            if (!$updating && $category->isDirty('path')) {
                $updating = true;
                $category->updateDescendantsPaths();
                $updating = false;
            }
        });
    }
}
