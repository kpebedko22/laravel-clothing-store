<?php

namespace App\Livewire\Web\Catalog;

use App\DTOs\Web\Products\ProductCardDTO;
use App\Services\FavoriteProducts\FavoriteProductServiceFactory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductCard extends Component
{
    public ProductCardDTO $data;

    public function toggleFavorite(): void
    {
        $isFavorite = $this->data->isFavorite()
            ? FavoriteProductServiceFactory::service()->remove($this->data->getProductId())
            : FavoriteProductServiceFactory::service()->store($this->data->getProductId());

        $this->data->setIsFavorite($isFavorite);

        $this->dispatch('favoriteProductsChanged');
    }

    public function render(): View
    {
        return view('livewire.web.catalog.product-card');
    }
}
