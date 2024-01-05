<?php

namespace App\Services\Web\Auth;

use App\DTOs\Auth\OAuthRegisterDTO;
use App\DTOs\Auth\OAuthUserDTO;
use App\Enums\Auth\OAuthProvider;
use App\Exceptions\Auth\OAuthException;
use App\Models\SocialAccount;
use App\Models\User;
use App\Notifications\Auth\OAuthChanged;
use App\Notifications\Auth\Registration;
use App\Repositories\SocialAccounts\SocialAccountRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class OAuthService
{
    public function __construct(
        private readonly SocialAccountRepository $socialAccountRepository,
    ) {
    }

    /**
     * Поиск пользователя через аккаунт соц. сети
     */
    public function auth(OAuthUserDTO $data): ?User
    {
        return $this->socialAccountRepository
            ->findByProviderAndId($data->provider, $data->id)
            ?->user;
    }

    /**
     * Регистрация пользователя через соц. сеть
     */
    public function register(OAuthRegisterDTO $data): User
    {
        // TODO: move to abstract
        return DB::transaction(function () use ($data): User {
            $password = Str::password(config('auth.password_min_length'));

            $user = User::query()
                ->create(array_merge(['password' => $password], $data->toArray()));

            SocialAccount::query()
                ->create(array_merge(['user_id' => $user->id], $data->oAuthData->toArray()));

            // Отправить письмо с паролем
            $user->notify(Registration::oAuth($data->oAuthData->provider, $password));

            return $user;
        });
    }

    /**
     * Привязка аккаунта соц. сети к пользователю
     */
    public function connect(User $user, OAuthUserDTO $data): User
    {
        // 1. У текущего пользователя уже есть аккаунт соц. сети
        // TODO: to repository
        $socialAccountAlreadyExists = $user->socialAccounts()->where(['provider' => $data->provider])->exists();

        if ($socialAccountAlreadyExists) {
            throw OAuthException::alreadyConnected($data->provider, $data->email);
        }

        // 2. Выбранный аккаунт соц. сети уже есть в системе
        // TODO: to repository
        $socialAccountAlreadyTaken = SocialAccount::query()
            ->where([
                'provider' => $data->provider,
                'social_id' => $data->id,
            ])
            ->exists();

        if ($socialAccountAlreadyTaken){
            throw OAuthException::alreadyTaken($data->provider, $data->email);
        }

        $user->socialAccounts()->create($data->toArray());

        $user->notify(OAuthChanged::connected($data->provider));

        return $user;
    }

    /**
     * Отвязка аккаунта соц. сети от пользователя
     */
    public function disconnect(User $user, OAuthProvider $provider): User
    {
        $deleted = $user->socialAccounts()->where(['provider' => $provider])->delete();

        if ($deleted) {
            $user->notify(OAuthChanged::disconnected($provider));
        }

        return $user;
    }
}
