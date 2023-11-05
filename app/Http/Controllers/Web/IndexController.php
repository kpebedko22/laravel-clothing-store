<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(): View
    {
        return view('web.index.index', [
            'popularProducts' => Product::inRandomOrder()->limit(4)->get(),
        ]);
    }
}
