<?php

namespace App\Services\Web\Auth;

use App\DTOs\Auth\OAuthUserDTO;
use App\Exceptions\Auth\OAuthException;
use App\Helpers\RandomHelper;
use App\Models\User;
use App\Notifications\Auth\Registration;
use App\Repositories\Users\UserAuthRepository;

final class OAuthService
{
    public function __construct(private readonly UserAuthRepository $repository)
    {
    }

    public function auth(OAuthUserDTO $data): ?User
    {
        // 1. Найти пользователя по id из внешнего сервиса {provider}_id
        $user = $this->repository->firstByOAuthId($data->provider, $data->id);

        if ($user) {
            return $user;
        }

        // 2. Найти пользователя по email. Если есть - значит пользователь должен самостоятельно привязать аккаунт.
        $user = $this->repository->firstByEmail($data->email);

        if ($user) {
            throw OAuthException::credentialsAlreadyInUse($data->provider, $data->email);
        }

        // 3. Можно зарегистрировать нового пользователя.
        $password = RandomHelper::string(config('auth.password_min_length'));

        $user = User::create(array_merge(['password' => $password], $data->toArray()));

        $user->notify(Registration::oAuth($data->provider, $password));

        return $user;
    }
}
