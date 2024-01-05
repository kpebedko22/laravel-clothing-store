<?php

namespace App\DTOs\Auth;

use App\Enums\Auth\OAuthProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Contracts\User;
use Livewire\Wireable;

final class OAuthUserDTO implements Arrayable, Wireable
{
    public function __construct(
        public readonly OAuthProvider $provider,
        public readonly string        $id,
        public readonly ?string       $email,
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
                '+$1($2)$3-$4-$5',
                preg_replace('/[^0-9]/', '', $phone)
            );
        }

        $birthday = Arr::get($user->user, 'birthday');
        $birthday = $birthday
            ? Carbon::createFromFormat('Y-m-d', $birthday)
            : null;

        return new OAuthUserDTO(
            $provider,
            $user->getId(),
            $user->getEmail(),
            Arr::get($user->user, 'first_name', $user->getName()),
            Arr::get($user->user, 'last_name'),
            $phone,
            Arr::get($user->user, 'sex'),
            $birthday,
        );
    }

    public function toArray(): array
    {
        return [
            'social_id' => $this->id,
            'provider' => $this->provider,
            'name' => trim("$this->firstName $this->lastName"),
        ];
    }

    public function toLivewire(): array
    {
        return [
            'provider' => $this->provider->value,
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'birthday' => $this->birthday?->toString(),
        ];
    }

    public static function fromLivewire($value): OAuthUserDTO
    {
        return new OAuthUserDTO(
            OAuthProvider::from(Arr::get($value, 'provider')),
            Arr::get($value, 'id'),
            Arr::get($value, 'email'),
            Arr::get($value, 'first_name'),
            Arr::get($value, 'last_name'),
            Arr::get($value, 'phone'),
            Arr::get($value, 'gender'),
            Carbon::parse(Arr::get($value, 'birthday')),
        );
    }
}
