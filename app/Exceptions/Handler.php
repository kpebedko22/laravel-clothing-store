<?php

namespace App\Exceptions;

use App\Exceptions\Auth\OAuthException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (OAuthException $e, $request) {
            if ($previous = $e->getPrevious()) {
                Log::error('OAuth: ' . $previous->getMessage());
            }

            $route = Auth::check()
                // TODO: web.personal.social_accounts or web.personal.social_accounts.index (?)
                ? 'web.personal.profile'
                : 'web.auth.index';

            return redirect()
                ->route($route)
                ->withErrors($e->getMessage(), 'oauth');
        });

        $this->reportable(function (Throwable $e) {
        });
    }
}
