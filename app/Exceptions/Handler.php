<?php

namespace App\Exceptions;

use App\Exceptions\Auth\OAuthException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

            return redirect()
                ->route('web.auth.index')
                ->withErrors($e->getMessage(), 'oauth');
        });

        $this->reportable(function (Throwable $e) {
        });
    }
}
