<?php

namespace App\Livewire\Web\Partials;

use App\Services\FavoriteProducts\FavoriteProductServiceFactory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FavoriteProductButton extends Component
{
    public int $count;

    protected $listeners = [
        'favoriteProductsChanged' => '$refresh',
    ];

    public function boot(): void
    {
        $this->count = FavoriteProductServiceFactory::service()->count();
    }

    public function render(): View
    {
        return view('livewire.web.partials.favorite-product-button');
    }
}
