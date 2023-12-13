<?php

namespace App\Services\FavoriteProducts;

use Illuminate\Support\Facades\Auth;

class FavoriteProductServiceFactory
{
    public static function service(): ?IFavoriteProductService
    {
        return Auth::user()
            ? null
            : new FavoriteProductSessionService;
    }
}
