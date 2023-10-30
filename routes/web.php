<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothingStoreController;

Route::get('/', [ClothingStoreController::class, 'index'])->name('index');

Route::get('/catalog', [ClothingStoreController::class, 'catalog'])->name('catalog');

Route::get('/products-administration', [ClothingStoreController::class, 'products_administration'])->name('items.list');

Route::get('/single-product-{id}', [ClothingStoreController::class, 'single_product'])->name('items.read');

Route::get('/cart', [ClothingStoreController::class, 'cart'])->name('cart');

Route::get('create-item', [ClothingStoreController::class, 'createItem'])->name('clothes.create');
Route::post('add-item-to-db', [ClothingStoreController::class, 'addItemToDB'])->name('clothes.add');

Route::delete('/delete-from-db-{id}', [ClothingStoreController::class, 'deleteItemFromDB'])->name('clothes.delete');

Route::get('edit-item-{id}', [ClothingStoreController::class, 'editItem'])->name('clothes.edit');
Route::post('update-item-{id}', [ClothingStoreController::class, 'updateItem'])->name('clothes.update');

Route::get('add-item-to-cart-{id}', [ClothingStoreController::class, 'addItemToCart'])->name('cart.add');
Route::get('delete-from-cart-{id}', [ClothingStoreController::class, 'deleteItemFromCart'])->name('cart.delete');
Route::post('create-order', [ClothingStoreController::class, 'createOrder'])->name('cart.create');

Route::get('/preview-item-{id}', [ClothingStoreController::class, 'previewItem']);
Route::get('/preview-cart', [ClothingStoreController::class, 'previewCart']);
Route::delete('/delete-response-from-db', [ClothingStoreController::class, 'deleteItemFromDBResponse']);
