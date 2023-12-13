<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $client_name
 * @property string $client_phone
 * @property string $client_email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static OrderFactory factory($count = null, $state = [])
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 *
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
