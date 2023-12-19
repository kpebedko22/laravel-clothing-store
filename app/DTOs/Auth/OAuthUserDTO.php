<?php

namespace App\DTOs\Auth;

use App\Enums\Auth\OAuthProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Contracts\User;

final class OAuthUserDTO implements Arrayable
{
    public function __construct(
        public readonly OAuthProvider $provider,
        public readonly string        $id,
        public readonly string        $email,
        public readonly ?string       $firstName = null,
        public readonly ?string       $lastName = null,
        public readonly ?string       $phone = null,
        public readonly ?string       $gender = null,
        public readonly ?Carbon       $birthday = null,
    ) {
    }

    public static function fromUser(OAuthProvider $provider, User $user): OAuthUserDTO
    {
        $phone = Arr::get($user->user, 'default_phone.number');
        if ($phone) {
            $phone = preg_replace(
                "/^(\d)(\d{3})(\d{3})(\d{2})(\d{2})$/",
                "+$1($2)$3-$4-$5",
                preg_replace("/[^0-9]/", "", $phone)
            );
        }

        return match ($provider) {
            OAuthProvider::Yandex => new OAuthUserDTO(
                OAuthProvider::Yandex,
                $user->getId(),
                $user->getEmail(),
                Arr::get($user->user, 'first_name', $user->getName()),
                Arr::get($user->user, 'last_name'),
                $phone,
                Arr::get($user->user, 'sex'),
                Carbon::createFromFormat('Y-m-d', Arr::get($user->user, 'birthday')),
            ),
        };
    }

    public function toArray(): array
    {
        return [
            $this->provider->dbColumn() => $this->id,
            'email' => $this->email,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
        ];
    }
}
