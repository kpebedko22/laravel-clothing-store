<?php

namespace App\Http\Controllers\Web\Auth;

use App\DTOs\Auth\OAuthUserDTO;
use App\Exceptions\Auth\OAuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\OAuthRequest;
use App\Services\Web\Auth\OAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public function callback(OAuthRequest $request): RedirectResponse
    {
        $authorizedUser = Auth::user();

        $provider = $request->getProvider();

        try {
            $userData = Socialite::driver($provider->value)->user();
        } catch (Throwable $e) {
            throw OAuthException::default($provider, $e);
        }

        $data = OAuthUserDTO::fromUser($provider, $userData);

        if (!$authorizedUser) {
            $user = $this->service->auth($data);
            Auth::guard('web')->login($user);
        } else {
            $this->service->connect($authorizedUser, $data);
        }

        return redirect()->route('web.personal.index');
    }
}
