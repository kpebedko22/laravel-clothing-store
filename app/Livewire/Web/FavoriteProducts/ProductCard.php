<?php

namespace App\Livewire\Web\FavoriteProducts;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductCard extends Component
{
    public function render(): View
    {
        return view('livewire.web.favorite-products.product-card');
    }
}
