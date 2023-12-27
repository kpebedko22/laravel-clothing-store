<?php

namespace App\Models;

use Database\Factories\ColorFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Color
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Product> $products
 * @property-read int|null $products_count
 *
 * @method static ColorFactory factory($count = null, $state = [])
 * @method static Builder|Color newModelQuery()
 * @method static Builder|Color newQuery()
 * @method static Builder|Color query()
 *
 * @mixin Eloquent
 */
class Color extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products(): HasMany|Product
    {
        return $this->hasMany(Product::class, 'color_id', 'id');
    }
}
