<?php

namespace App\Exceptions\Auth;

use App\Enums\Auth\OAuthProvider;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

final class OAuthException extends RuntimeException
{
    public static function default(OAuthProvider $provider, Throwable $previous): self
    {
        return new OAuthException(
            __('exceptions/oauth.default', [
                'provider' => Str::headline($provider->value),
            ]),
            $previous->getCode(),
            $previous,
        );
    }

    public static function credentialsAlreadyInUse(OAuthProvider $provider, string $email): self
    {
        return new OAuthException(
            __('exceptions/oauth.credentials_already_in_use', [
                'provider' => Str::headline($provider->value),
                'email' => $email,
            ])
        );
    }
}
