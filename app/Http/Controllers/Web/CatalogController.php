<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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

    public function index(?string $path = null): View
    {
        if ($path) {
            $category = $this->categoryRepository->findByPath($path);
            $childCategories = $this->categoryRepository->childCategories($category->id);
        } else {
            $category = null;
            $childCategories = $this->categoryRepository->childCategoriesForCatalog();
        }

        return view('web.catalog.index', [
            'category' => $category,
            'childCategories' => $childCategories,
        ]);
    }
}
