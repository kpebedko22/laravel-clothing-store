<?php

namespace App\Services\FavoriteProducts;

use Illuminate\Support\Collection;

interface FavoriteProductServiceInterface
{
    public function count(): int;

    public function toggle(): void;

    public function info(int $productId);

    public function isFavorite(int $productId): bool;

    public function areFavorite(Collection $productsIds): Collection;

    public function all(): Collection;

    public function store(int $productId): bool;

    public function remove(int $productId): bool;
}
