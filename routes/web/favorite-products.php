<?php

use App\Http\Controllers\Web\FavoriteProductController;

Route::prefix('favorite')
    ->name('favorite_products.')
    ->controller(FavoriteProductController::class)
    ->group(function () {
        Route::get('', 'index')
            ->name('index');
    });
