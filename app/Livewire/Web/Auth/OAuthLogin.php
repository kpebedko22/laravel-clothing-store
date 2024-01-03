<?php

namespace App\Livewire\Web\Auth;

use App\DTOs\Auth\OAuthRegisterDTO;
use App\DTOs\Auth\OAuthUserDTO;
use App\Providers\RouteServiceProvider;
use App\Services\Web\Auth\OAuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class OAuthLogin extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public OAuthUserDTO $oAuthData;

    public function mount(OAuthUserDTO $data): void
    {
        $this->oAuthData = $data;
        $this->email = $this->oAuthData->email;
    }

    public function newAccount(): void
    {
        $this->validate([
            'email' => ['required', 'email', 'unique:users,email'],
        ]);

        try {
            /** @var OAuthService $service */
            $service = App::make(OAuthService::class);

            $user = $service->register(new OAuthRegisterDTO($this->email, $this->oAuthData));

        } catch (Throwable $ex) {
            $this->addError('email', "Ошибка регистрации. Попробуйте позже. {$ex->getMessage()}");

            return;
        }

        Auth::login($user);

        redirect(RouteServiceProvider::HOME);
    }

    public function existedAccount(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($this->only(['email', 'password']), $this->remember)) {

            $user = Auth::user();

            /** @var OAuthService $service */
            $service = App::make(OAuthService::class);

            $service->connect($user, $this->oAuthData);

            redirect(RouteServiceProvider::HOME);
        }

        $this->addError('email', __('validation.invalid_credentials', ['attribute' => 'email']));
    }

    public function render(): View
    {
        return view('livewire.web.auth.o-auth-login');
    }
}
