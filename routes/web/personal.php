<?php

use App\Http\Controllers\Web\Personal\PersonalController;

Route::prefix('personal')
    ->name('personal.')
    ->group(function () {
        Route::get('', [PersonalController::class, 'index'])
            ->middleware([
                'auth:web',
            ])
            ->name('index');
    });
