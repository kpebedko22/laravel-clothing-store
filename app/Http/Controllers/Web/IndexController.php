<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
    ) {
    }

    public function index(): View
    {
        return view('web.index.index', [
            'popularProducts' => $this->productRepository->forIndex(),
        ]);
    }
}
