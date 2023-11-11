<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class ProductRepository
{
    protected function defaultQuery(): Builder|Product
    {
        return Product::query()
            ->with([
                'media',
                'category',
            ]);
    }

    public function show(string $slug): Product
    {
        return Product::query()
            ->where(['slug' => $slug])
            ->firstOrFail();
    }

    public function forIndex(): Collection
    {
        return $this->defaultQuery()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function forCatalog(): LengthAwarePaginator
    {
        return $this->defaultQuery()
            ->paginate();
    }

    public function forCategory(Category $category): Collection
    {
        $categories = $category->descendants()->pluck('id')->toArray();
        $categories[] = $category->id;

        return $this->defaultQuery()
            ->whereIntegerInRaw('category_id', $categories)
            ->get();
    }
}
