<?php

namespace App\Services\FavoriteProducts;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class FavoriteProductSessionService implements FavoriteProductServiceInterface
{
    protected function getSessionKey(?int $productId = null): string
    {
        return $productId
            ? "favorite_products.$productId"
            : 'favorite_products';
    }

    protected function getSessionProductKey(int $productId, string $key): string
    {
        return self::getSessionKey($productId) . '.' . $key;
    }

    public function count(): int
    {
        return count(Session::get(self::getSessionKey()));
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
        return (bool)Session::get(self::getSessionKey($productId));
    }

    public function areFavorite(Collection $productsIds): Collection
    {
        // TODO: Implement areFavorite() method.
        return collect();
    }

    public function all(): Collection
    {
        // TODO: Implement all() method.
        return collect();
    }

    public function store(int $productId): bool
    {
        Session::put(self::getSessionKey($productId), [
            'productId' => $productId,
        ]);

        return true;
    }

    public function remove(int $productId): bool
    {
        Session::forget(self::getSessionKey($productId));

        return false;
    }

    public function clear(): void
    {
        Session::forget(self::getSessionKey());
    }
}
