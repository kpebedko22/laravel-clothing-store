<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected ProductRepository  $productRepository,
    )
    {
    }

    public function index(): View
    {
        $childCategories = $this->categoryRepository->childCategoriesForCatalog();
        $products = $this->productRepository->forCatalog();

        return view('web.catalog.index', [
            'childCategories' => $childCategories,
            'products' => $products,
        ]);
    }

    public function category(string $path): View
    {
        $category = $this->categoryRepository->findByPath($path);
        $childCategories = $this->categoryRepository->childCategories($category->id);
        $products = $this->productRepository->forCategory($category);

        return view('web.catalog.category', [
            'category' => $category,
            'childCategories' => $childCategories,
            'products' => $products,
        ]);
    }
}
