<?php

namespace App\Notifications\Auth;

use App\Enums\Auth\OAuthProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class OAuthChanged extends Notification implements ShouldQueue
{
    use Queueable;

    private const CONNECTED = 'connected';

    private const DISCONNECTED = 'disconnected';

    private function __construct(
        private readonly OAuthProvider $provider,
        private readonly string        $type,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public static function connected(OAuthProvider $provider): OAuthChanged
    {
        return new OAuthChanged($provider, self::CONNECTED);
    }

    public static function disconnected(OAuthProvider $provider): OAuthChanged
    {
        return new OAuthChanged($provider, self::DISCONNECTED);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $transPrefix = "notifications/auth/o-auth-changed.$this->type.mail";

        $provider = $this->provider->getLabel();
        $app = config('app.name');

        return (new MailMessage)
            ->subject(__("$transPrefix.subject", ['provider' => $provider, 'app' => $app]))
            ->greeting(__("$transPrefix.greeting", ['provider' => $provider]))
            ->line(__("$transPrefix.line", ['provider' => $provider, 'app' => $app]));
    }
}
