<?php

use App\Http\Controllers\Web\Personal\PersonalController;

Route::prefix('personal')
    ->name('personal.')
    ->middleware([
        'auth:web',
    ])
    ->controller(PersonalController::class)
    ->group(function () {
        Route::get('', 'index')
            ->name('index');

        Route::get('profile', 'profile')
            ->name('profile');

        Route::get('social-accounts', 'socialAccounts')
            ->name('social_accounts');
    });
