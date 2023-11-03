<?php

namespace App\Models;

use Database\Factories\SizeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection<int, Product> $products
 * @property-read int|null $products_count
 *
 * @method static SizeFactory factory($count = null, $state = [])
 * @method static Builder|Size newModelQuery()
 * @method static Builder|Size newQuery()
 * @method static Builder|Size query()
 *
 * @mixin Eloquent
 */
class Size extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products(): HasMany|Product
    {
        return $this->hasMany(Product::class, 'size_id', 'id');
    }
}
