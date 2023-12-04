<?php

namespace App\Repositories\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;

final class FavoriteProductRepository
{
    public function productsByIds(array $ids): Collection
    {
        if (!$ids) {
            return collect();
        }

        $sortedIds = implode(',', $ids);

        return Product::query()
            ->whereIntegerInRaw('id', $ids)
            ->orderByRaw("FIELD(id, $sortedIds)")
            ->get();
    }

    public function productsForUser(User $user)
    {
        // todo: from relation
        // $user->favoriteProducts()->orderBy('favorite_product.created_at');
    }
}
