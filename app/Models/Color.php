<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperColor
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
