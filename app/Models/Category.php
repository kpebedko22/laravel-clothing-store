<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\QueryBuilder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $parent_id
 * @property int|null $root_category_id
 * @property int $_lft
 * @property int $_rgt
 * @property string $slug
 * @property string $path
 * @property array $breadcrumbs
 * @property-read int|null $products_count
 * @property-read int|null $children_count
 * @property-read \Kalnoy\Nestedset\Collection<int, Category> $children
 * @property-read Collection<int, Product> $products
 * @property-read Category|null $parent
 * @property-read Category|null $rootCategory
 *
 * @method static CategoryFactory factory($count = null, $state = [])
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static QueryBuilder|Category ancestorsAndSelf($id, array $columns = [])
 * @method static QueryBuilder|Category ancestorsOf($id, array $columns = [])
 * @method static QueryBuilder|Category defaultOrder(string $dir = 'asc')
 * @method static QueryBuilder|Category descendantsAndSelf($id, array $columns = [])
 * @method static QueryBuilder|Category descendantsOf($id, array $columns = [], $andSelf = false)
 *
 * @mixin Eloquent
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
}
