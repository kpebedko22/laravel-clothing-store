<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $category_id
 * @property int $color_id
 * @property int $size_id
 * @property string $name
 * @property string|null $desc
 * @property int $price
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Category $category
 * @property-read Color $color
 * @property-read Size $size
 *
 * @method static ProductFactory factory($count = null, $state = [])
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 *
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;

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
}
