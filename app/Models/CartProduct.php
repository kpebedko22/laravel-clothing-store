<?php

namespace App\Models;

use Database\Factories\CartProductFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static CartProductFactory factory($count = null, $state = [])
 * @method static Builder|CartProduct newModelQuery()
 * @method static Builder|CartProduct newQuery()
 * @method static Builder|CartProduct query()
 *
 * @mixin Eloquent
 */
class CartProduct extends Model
{
    use HasFactory;
}
