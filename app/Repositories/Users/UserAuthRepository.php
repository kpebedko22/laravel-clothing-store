<?php

namespace App\Repositories\Users;

use App\Enums\Auth\OAuthProvider;
use App\Models\User;

final class UserAuthRepository
{
    public function firstByOAuthId(OAuthProvider $provider, string $id): ?User
    {
        return User::query()->firstWhere([$provider->dbColumn() => $id]);
    }

    public function firstByEmail(string $email): ?User
    {
        return User::query()->firstWhere(['email' => $email]);
    }
}
