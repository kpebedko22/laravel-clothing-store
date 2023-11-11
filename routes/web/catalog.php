<?php

use App\Http\Controllers\Web\CatalogController;

Route::prefix('catalog')
    ->name('catalog.')
    ->controller(CatalogController::class)
    ->group(function () {
        Route::get('', 'index')
            ->name('index');

        Route::get('{path}', 'index')
            ->where('path', '.*')
            ->name('category');
    });
