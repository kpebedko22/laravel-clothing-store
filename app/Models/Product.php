<?php

namespace App\Models;

use App\Orders\Orderable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model implements HasMedia
{
    use HasFactory,
        HasSlug,
        InteractsWithMedia,
        Orderable;

    protected $guarded = ['id'];

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

    protected function humanPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->price / 100,
        );
    }
}
