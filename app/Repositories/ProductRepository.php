<?php

namespace App\Repositories;

use App\DTOs\Web\Products\ProductCardDTO;
use App\Models\Category;
use App\Models\Product;
use App\Orders\Products\ProductOrder;
use App\Orders\Sorters\SimpleSorter;
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
        $items = $this->defaultQuery()
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return $this->wrapToProductCard($items);
    }

    public function forCatalog(SimpleSorter $sorter, ?int $category = null): LengthAwarePaginator
    {
        $paginator = $this->defaultQuery();

        if ($category) {
            $category = Category::find($category);
            $categories = $category->descendants()->pluck('id')->toArray();
            $categories[] = $category->id;

            $paginator->whereIntegerInRaw('category_id', $categories);
        }

        $paginator = $paginator->order(new ProductOrder, $sorter)->paginate(16);

        $items = $this->wrapToProductCard(collect($paginator->items()));

        $paginator->setCollection($items);

        return $paginator;
    }

    protected function wrapToProductCard(Collection $products): Collection
    {
        return $products->map(function (Product $product) {

            return new ProductCardDTO(
                $product->id,
                $product->slug,
                $product->name,
                $product->desc,
                $product->human_price,
                $product->getFirstMediaUrl(),
                $product->category->path,
                $product->category->name,
                FavoriteProductServiceFactory::service()->isFavorite($product->id),
            );
        });
    }
}
