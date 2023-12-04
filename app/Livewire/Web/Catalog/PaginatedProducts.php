<?php

namespace App\Livewire\Web\Catalog;

use App\Enums\Catalog\CatalogSort;
use App\Orders\Sorters\SimpleSorter;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedProducts extends Component
{
    use WithPagination;

    public ?int $categoryId = null;

    public string $sort;

    protected array $queryString = [
        'sort' => [
            'except' => 'popularity', // TODO: remove hardcode
        ],
    ];

    public function mount(): void
    {
        $this->sort = $this->sort ?? CatalogSort::Popularity->value;
    }

    public function placeholder(): View
    {
        return view('placeholders.web.catalog.paginated-products');
    }

    public function render(): View
    {
        $sorter = SimpleSorter::make($this->sort);

        return view('livewire.web.catalog.paginated-products', [
            'products' => (new ProductRepository)->forCatalog($sorter, $this->categoryId),
        ]);
    }
}
