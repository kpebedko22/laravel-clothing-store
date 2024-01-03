<?php

namespace App\Repositories\SocialAccounts;

use App\Enums\Auth\OAuthProvider;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Collection;

final class SocialAccountRepository
{
    public function findByProviderAndId(OAuthProvider $provider, string $socialId): ?SocialAccount
    {
        return SocialAccount::query()
            ->where([
                'provider' => $provider,
                'social_id' => $socialId,
            ])
            ->first();
    }

    public function userSettings(User $user): Collection
    {
        return $user
            ->socialAccounts()
            ->get()
            ->mapWithKeys(fn(SocialAccount $account) => [
                $account->provider->value => $account,
            ]);
    }
}
