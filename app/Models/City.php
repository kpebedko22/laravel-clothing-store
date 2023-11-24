<?php

namespace App\Models;

use Database\Factories\CityFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int $id
 * @property int $region_id
 * @property string $name
 * @property string $alias
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Region $region
 *
 * @method static CityFactory factory($count = null, $state = [])
 * @method static Builder|City newModelQuery()
 * @method static Builder|City newQuery()
 * @method static Builder|City query()
 *
 * @mixin Eloquent
 */
class City extends Model
{
    use HasFactory,
        HasSlug;

    protected $guarded = ['id'];

    public function region(): BelongsTo|Region
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('alias');
    }
}
