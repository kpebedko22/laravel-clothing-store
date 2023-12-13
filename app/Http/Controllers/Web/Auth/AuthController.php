<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('web.auth.index');
    }
}
