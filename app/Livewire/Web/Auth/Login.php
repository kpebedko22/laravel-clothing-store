<?php

namespace App\Livewire\Web\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        if (Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            redirect(RouteServiceProvider::HOME);
        }

        $this->addError('email', 'Invalid credentials');
    }

    public function render(): View
    {
        return view('livewire.web.auth.login');
    }
}
