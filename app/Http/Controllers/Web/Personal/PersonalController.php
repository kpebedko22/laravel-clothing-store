<?php

namespace App\Http\Controllers\Web\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class PersonalController extends Controller
{
    public function index(): View
    {
        return view('web.personal.index');
    }
}
