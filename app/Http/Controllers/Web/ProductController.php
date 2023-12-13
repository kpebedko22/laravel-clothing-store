<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
    ) {
    }

    // Страница просмотра товара
    public function show(string $slug): View
    {
        $product = $this->productRepository->show($slug);

        return view('web.catalog.product', [
            'product' => $product,
        ]);
    }
}
