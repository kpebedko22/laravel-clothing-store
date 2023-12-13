<?php

use App\Http\Controllers\Web\Auth\AuthController;

Route::prefix('auth')
    ->name('auth.')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('', 'index')
            ->name('index');
    });
