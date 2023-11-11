<?php

namespace App\Livewire\Web\Catalog;

use App\Services\FavoriteProducts\FavoriteProductServiceFactory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductCardFavoriteToggle extends Component
{
    public int $productId;

    public bool $isFavorite;

    public function toggle(): void
    {
        $this->isFavorite = $this->isFavorite
            ? FavoriteProductServiceFactory::service()->remove($this->productId)
            : FavoriteProductServiceFactory::service()->store($this->productId);

        $this->dispatch('favoriteProductsChanged');
    }

    public function render(): View
    {
        return view('livewire.web.catalog.product-card-favorite-toggle');
    }
}
