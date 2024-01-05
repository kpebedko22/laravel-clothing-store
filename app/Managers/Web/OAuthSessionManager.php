<?php

namespace App\Managers\Web;

use App\DTOs\Auth\OAuthUserDTO;
use App\Enums\Auth\OAuthProvider;
use Illuminate\Support\Facades\Session;

final class OAuthSessionManager
{
    public static function getData(OAuthProvider $provider): mixed
    {
        return Session::get(self::getKey($provider));
    }

    public static function putData(OAuthProvider $provider, OAuthUserDTO $data): void
    {
        Session::put(self::getKey($provider), $data);
    }

    private static function getKey(OAuthProvider $provider): string
    {
        return "oauth.$provider->value";
    }
}
