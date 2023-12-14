<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperRegion
 */
class Region extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cities(): HasMany|City
    {
        return $this->hasMany(City::class, 'region_id', 'id');
    }
}
