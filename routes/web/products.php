<?php

use App\Http\Controllers\Web\ProductController;

Route::prefix('products')
    ->name('products.')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('{slug}', 'show')
            ->name('show');
    });
