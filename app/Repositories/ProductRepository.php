<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

final class ProductRepository
{
    public function show(string $slug): Product
    {
        return Product::query()
            ->where(['slug' => $slug])
            ->firstOrFail();
    }

    public function forCatalog(): LengthAwarePaginator
    {
        return Product::query()
            ->with([
                'category',
            ])
            ->paginate();
    }

    public function forCategory(Category $category): Collection
    {
        $categories = $category->descendants()->pluck('id')->toArray();
        $categories[] = $category->id;

        return Product::query()
            ->with([
                'category',
            ])
            ->whereIn('category_id', $categories)
            ->get();
    }
}
