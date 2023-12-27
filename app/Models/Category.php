<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Kalnoy\Nestedset\Collection;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\QueryBuilder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $root_category_id
 * @property int $_lft
 * @property int $_rgt
 * @property string $name
 * @property string $slug
 * @property string $path
 * @property array $breadcrumbs
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $products
 * @property-read int|null $products_count
 * @property-read Category|null $rootCategory
 *
 * @method static Collection<int, static> all($columns = ['*'])
 * @method static QueryBuilder|Category ancestorsAndSelf($id, array $columns = [])
 * @method static QueryBuilder|Category ancestorsOf($id, array $columns = [])
 * @method static QueryBuilder|Category applyNestedSetScope(?string $table = null)
 * @method static QueryBuilder|Category countErrors()
 * @method static QueryBuilder|Category d()
 * @method static QueryBuilder|Category defaultOrder(string $dir = 'asc')
 * @method static QueryBuilder|Category descendantsAndSelf($id, array $columns = [])
 * @method static QueryBuilder|Category descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static CategoryFactory factory($count = null, $state = [])
 * @method static QueryBuilder|Category fixSubtree($root)
 * @method static QueryBuilder|Category fixTree($root = null)
 * @method static Collection<int, static> get($columns = ['*'])
 * @method static QueryBuilder|Category getNodeData($id, $required = false)
 * @method static QueryBuilder|Category getPlainNodeData($id, $required = false)
 * @method static QueryBuilder|Category getTotalErrors()
 * @method static QueryBuilder|Category hasChildren()
 * @method static QueryBuilder|Category hasParent()
 * @method static QueryBuilder|Category isBroken()
 * @method static QueryBuilder|Category leaves(array $columns = [])
 * @method static QueryBuilder|Category makeGap(int $cut, int $height)
 * @method static QueryBuilder|Category moveNode($key, $position)
 * @method static QueryBuilder|Category newModelQuery()
 * @method static QueryBuilder|Category newQuery()
 * @method static QueryBuilder|Category orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static QueryBuilder|Category orWhereDescendantOf($id)
 * @method static QueryBuilder|Category orWhereNodeBetween($values)
 * @method static QueryBuilder|Category orWhereNotDescendantOf($id)
 * @method static QueryBuilder|Category query()
 * @method static QueryBuilder|Category rebuildSubtree($root, array $data, $delete = false)
 * @method static QueryBuilder|Category rebuildTree(array $data, $delete = false, $root = null)
 * @method static QueryBuilder|Category reversed()
 * @method static QueryBuilder|Category root(array $columns = [])
 * @method static QueryBuilder|Category whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static QueryBuilder|Category whereAncestorOrSelf($id)
 * @method static QueryBuilder|Category whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static QueryBuilder|Category whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static QueryBuilder|Category whereIsAfter($id, $boolean = 'and')
 * @method static QueryBuilder|Category whereIsBefore($id, $boolean = 'and')
 * @method static QueryBuilder|Category whereIsLeaf()
 * @method static QueryBuilder|Category whereIsRoot()
 * @method static QueryBuilder|Category whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static QueryBuilder|Category whereNotDescendantOf($id)
 * @method static QueryBuilder|Category withDepth(string $as = 'depth')
 * @method static QueryBuilder|Category withoutRoot()
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
