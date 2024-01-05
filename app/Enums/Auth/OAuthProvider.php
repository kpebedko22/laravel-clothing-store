<?php

namespace App\Enums\Auth;

enum OAuthProvider: string
{
    case Yandex = 'yandex';

    case Google = 'google';

    case Vkontakte = 'vkontakte';

    public static function values(): array
    {
        return array_map(function (OAuthProvider $case) {
            return $case->value;
        }, self::cases());
    }

    public function getLabel(): string
    {
        return __("enums/auth/o-auth-provider.$this->value");
    }

    public function getIconBlade(): string
    {
        return "web.oauth-icons.$this->value";
    }
}
