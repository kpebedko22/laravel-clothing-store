<?php

namespace App\Models;

use App\Orders\EloquentQueryOrder;
use App\Orders\Orderable;
use App\Orders\Sorters\Sorter;
use Database\Factories\ProductFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int $id
 * @property int $category_id
 * @property int $color_id
 * @property int $size_id
 * @property string $name
 * @property string|null $desc
 * @property int $price
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category $category
 * @property-read Color $color
 * @property-read Size $size
 * @property-read float $human_price
 *
 * @method static ProductFactory factory($count = null, $state = [])
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product order(EloquentQueryOrder $order, Sorter $sorter)
 *
 * @mixin Eloquent
 */
class Product extends Model implements HasMedia
{
    use HasFactory,
        HasSlug,
        InteractsWithMedia,
        Orderable;

    protected $guarded = ['id'];

    protected function humanPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->price / 100,
        );
    }

    public function size(): BelongsTo|Size
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function category(): BelongsTo|Category
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function color(): BelongsTo|Color
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->useFallbackUrl('/img/products/placeholder.svg')
            ->useFallbackPath(public_path('/img/products/placeholder.svg'));
    }
}
