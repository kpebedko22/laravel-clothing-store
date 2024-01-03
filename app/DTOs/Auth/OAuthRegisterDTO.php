<?php

namespace App\DTOs\Auth;

use Illuminate\Contracts\Support\Arrayable;

final class OAuthRegisterDTO implements Arrayable
{
    public function __construct(
        public readonly string       $email,
        public readonly OAuthUserDTO $oAuthData,
    ) {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'first_name' => $this->oAuthData->firstName,
            'last_name' => $this->oAuthData->lastName,
            'phone' => $this->oAuthData->phone,
            'gender' => $this->oAuthData->gender,
            'birthday' => $this->oAuthData->birthday,
        ];
    }
}
