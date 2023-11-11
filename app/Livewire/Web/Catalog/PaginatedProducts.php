<?php

namespace App\Livewire\Web\Catalog;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedProducts extends Component
{
    use WithPagination;

    public ?int $categoryId = null;

    public function placeholder(): View
    {
        return view('placeholders.web.catalog.paginated-products');
    }

    public function render(): View
    {
        return view('livewire.web.catalog.paginated-products', [
            'products' => $this->categoryId
                ? (new ProductRepository)->forCategory($this->categoryId)
                : (new ProductRepository)->forCatalog(),
        ]);
    }
}
