<?php

namespace App\Services\FavoriteProducts;

use App\Models\User;
use Illuminate\Support\Collection;

class FavoriteProductDBService implements IFavoriteProductService
{
    public function __construct(private User $user)
    {
    }

    public function count(): int
    {
        return 0; // TODO: Implement count() method.
    }

    public function toggle(): void
    {
        // TODO: Implement toggle() method.
    }

    public function info(int $productId)
    {
        // TODO: Implement info() method.
    }

    public function isFavorite(int $productId): bool
    {
        return true; // TODO: Implement isFavorite() method.
    }

    public function areFavorite(Collection $productsIds): Collection
    {
        // TODO: Implement areFavorite() method.
    }

    public function all(): Collection
    {
        // TODO: Implement all() method.
    }

    public function store(int $productId): bool
    {
        // TODO: Implement store() method.
    }

    public function remove(int $productId): bool
    {
        // TODO: Implement remove() method.
    }
}
