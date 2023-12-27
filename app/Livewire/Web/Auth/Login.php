<?php

namespace App\Livewire\Web\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class Login extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        if (Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            redirect(RouteServiceProvider::HOME);
        }

        $this->addError('email', __('validation.invalid_credentials', ['attribute' => 'email']));
    }

    public function render(): View
    {
        return view('livewire.web.auth.login');
    }
}
