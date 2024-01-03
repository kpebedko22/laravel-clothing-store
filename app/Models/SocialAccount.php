<?php

namespace App\Models;

use App\Enums\Auth\OAuthProvider;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserSocialNetwork
 *
 * @property int $id
 * @property int $user_id
 * @property OAuthProvider $provider
 * @property string $social_id
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|SocialAccount newModelQuery()
 * @method static Builder|SocialAccount newQuery()
 * @method static Builder|SocialAccount query()
 *
 * @property-read User $user
 *
 * @mixin Eloquent
 */
class SocialAccount extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'provider' => OAuthProvider::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
