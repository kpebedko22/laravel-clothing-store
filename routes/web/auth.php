<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Auth\OAuthController;

Route::prefix('auth')
    ->name('auth.')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('', 'index')
            ->middleware([
                'guest:web',
            ])
            ->name('index');

        Route::post('logout', 'logout')
            ->middleware([
                'auth:web',
            ])
            ->name('logout');

        Route::prefix('oauth/{provider}')
            ->whereIn('provider', \App\Enums\Auth\OAuthProvider::values())
            ->name('oauth.')
            ->controller(OAuthController::class)
            ->group(function () {
                Route::get('redirect', 'redirect')
                    ->name('redirect');

                Route::get('callback', 'callback')
                    ->name('callback');
            });
    });
