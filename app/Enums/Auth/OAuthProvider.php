<?php

namespace App\Enums\Auth;

enum OAuthProvider: string
{
    case Yandex = 'yandex';

    public static function values(): array
    {
        return array_map(function (OAuthProvider $case) {
            return $case->value;
        }, self::cases());
    }

    public function dbColumn(): string
    {
        return $this->value . '_id';
    }
}
