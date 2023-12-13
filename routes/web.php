<?php

use App\Http\Controllers\ClothingStoreController;
use App\Http\Controllers\Web\IndexController;
use Illuminate\Support\Facades\Route;

Route::name('web.')
    ->group(function () {

        Route::get('/', [IndexController::class, 'index'])
            ->name('index');

        require __DIR__ . '/web/auth.php';
        require __DIR__ . '/web/catalog.php';
        require __DIR__ . '/web/products.php';
        require __DIR__ . '/web/favorite-products.php';
    });

Route::get('/cart', [ClothingStoreController::class, 'cart'])->name('cart');

Route::get('add-item-to-cart-{id}', [ClothingStoreController::class, 'addItemToCart'])->name('cart.add');
Route::get('delete-from-cart-{id}', [ClothingStoreController::class, 'deleteItemFromCart'])->name('cart.delete');
Route::post('create-order', [ClothingStoreController::class, 'createOrder'])->name('cart.create');

Route::get('/preview-item-{id}', [ClothingStoreController::class, 'previewItem']);
Route::get('/preview-cart', [ClothingStoreController::class, 'previewCart']);
