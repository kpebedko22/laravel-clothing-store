<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\FavoriteProducts\FavoriteProductServiceFactory;
use Illuminate\Contracts\View\View;

class FavoriteProductController extends Controller
{
    public function index(): View
    {
        $favoriteProducts = FavoriteProductServiceFactory::service()->all();

        return view('web.favorite-products.index', [
            'favoriteProducts' => $favoriteProducts,
        ]);
    }
}
