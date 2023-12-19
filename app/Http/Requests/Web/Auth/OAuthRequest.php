<?php

namespace App\Http\Requests\Web\Auth;

use App\Enums\Auth\OAuthProvider;
use Illuminate\Foundation\Http\FormRequest;

class OAuthRequest extends FormRequest
{
    public function getProvider(): OAuthProvider
    {
        return OAuthProvider::from($this->route('provider'));
    }
}
