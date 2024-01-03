<?php

namespace App\Http\Controllers\Web\Personal;

use App\Http\Controllers\Controller;
use App\Repositories\SocialAccounts\SocialAccountRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    public function index(): View
    {
        return view('web.personal.index');
    }

    public function profile(): View
    {
        return view('web.personal.profile', [
            'socialAccounts' => (new SocialAccountRepository)->userSettings(Auth::user()),
        ]);
    }
}
