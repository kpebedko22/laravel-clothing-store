<?php

namespace App\Models;

use Database\Factories\RegionFactory;
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
 * @property-read Collection<int, City> $cities
 * @property-read int|null $cities_count
 *
 * @method static RegionFactory factory($count = null, $state = [])
 * @method static Builder|Region newModelQuery()
 * @method static Builder|Region newQuery()
 * @method static Builder|Region query()
 *
 * @mixin Eloquent
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
