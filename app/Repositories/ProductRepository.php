<?php

namespace App\Repositories;

use App\DTOs\Web\Products\ProductCardDTO;
use App\Models\Category;
use App\Models\Product;
use App\Services\FavoriteProducts\FavoriteProductServiceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
        $paginator = $this->defaultQuery()->paginate();

        $items = $this->wrapToProductCard(collect($paginator->items()));

        $paginator->setCollection($items);

        return $paginator;
    }

    public function forCategory(Category $category): Collection
    {
        $categories = $category->descendants()->pluck('id')->toArray();
        $categories[] = $category->id;

        $items = $this->defaultQuery()
            ->whereIntegerInRaw('category_id', $categories)
            ->get();

        $items = $this->wrapToProductCard($items);

        return $items;
    }

    protected function wrapToProductCard(Collection $products): Collection
    {
        return $products->map(function (Product $product) {

            return new ProductCardDTO(
                $product,
                FavoriteProductServiceFactory::service()->isFavorite($product->id),
            );
        });
    }
}
