<?php

namespace App\Services\FavoriteProducts;

use Illuminate\Support\Facades\Auth;

class FavoriteProductServiceFactory
{
    public static function service(): ?FavoriteProductServiceInterface
    {
        return Auth::user()
            ? null
            : new FavoriteProductSessionService;
    }
}
