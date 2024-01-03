<?php

namespace App\Enums\Auth;

enum OAuthProvider: string
{
    case Yandex = 'yandex';

    case Google = 'google';

    public static function values(): array
    {
        return array_map(function (OAuthProvider $case) {
            return $case->value;
        }, self::cases());
    }
}
