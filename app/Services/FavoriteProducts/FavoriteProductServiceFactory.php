<?php

namespace App\Services\FavoriteProducts;

use Illuminate\Support\Facades\Auth;

class FavoriteProductServiceFactory
{
    public static function service(): ?FavoriteProductServiceInterface
    {
        return $user = Auth::user()
            ? null
            : new FavoriteProductSessionService;
    }
}
