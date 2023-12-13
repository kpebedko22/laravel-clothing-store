<?php

namespace App\Managers\Web;

use Illuminate\Support\Facades\Session;

final class CityAliasCacheManager
{
    private const KEY = 'city_alias';

    public static function getAlias(): ?string
    {
        return Session::get(self::KEY);
    }

    public static function setAlias(string $cityAlias): void
    {
        Session::put(self::KEY, $cityAlias);
    }
}
