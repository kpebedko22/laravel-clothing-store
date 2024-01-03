<?php

namespace App\Http\Controllers\Web\Auth;

use App\DTOs\Auth\OAuthUserDTO;
use App\Exceptions\Auth\OAuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\OAuthRequest;
use App\Services\Web\Auth\OAuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

final class OAuthController extends Controller
{
    public function __construct(private readonly OAuthService $service)
    {
    }

    public function redirect(OAuthRequest $request): RedirectResponse
    {
        return Socialite::driver($request->getProvider()->value)->redirect();
    }

    /**
     * Если пользователь авторизованный, то происходит подключение соц. сети к пользователю.
     * Иначе если существует пользователь с выбранным аккаунтом соц. сети, то его логинит в системе.
     *
     * Если пользователь не найден, ему необходимо:
     * - либо войти с помощью пароля в свой аккаунт
     * - либо зарегистрироваться
     */
    public function callback(OAuthRequest $request): RedirectResponse|View
    {
        $authorizedUser = Auth::user();

        $provider = $request->getProvider();

        try {
            $userData = Socialite::driver($provider->value)->user();
        } catch (Throwable $e) {
            throw OAuthException::default($provider, $e);
        }

        $data = OAuthUserDTO::fromUser($provider, $userData);

        // Привязка соц. сети к авторизованному пользователю
        if ($authorizedUser) {
            $this->service->connect($authorizedUser, $data);

            return redirect()->route('web.personal.profile');
        }

        $user = $this->service->auth($data);

        if ($user) {
            Auth::guard('web')->login($user, true);

            return redirect()->route('web.personal.index');
        }

        Session::put("oauth.{$data->provider->value}", $data);

        return redirect()->route('web.auth.oauth.new', [$data->provider]);
    }

    /**
     * Страница привязки неавторизованного пользователя к соц. сети.
     */
    public function new(OAuthRequest $request): View
    {
        $provider = $request->getProvider();

        $data = Session::get("oauth.$provider->value");

        if (!$data) {
            throw OAuthException::default($provider);
        }

        return view('web.auth.oauth', ['data' => $data]);
    }

    /**
     * Запрос отвязки аккаунта соц. сети от авторизованного пользователя
     */
    public function disconnect(OAuthRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $this->service->disconnect($user, $request->getProvider());

        return redirect()->route('web.personal.profile');
    }
}
