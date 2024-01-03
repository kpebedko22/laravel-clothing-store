<?php

namespace App\Notifications\Auth;

use App\Enums\Auth\OAuthProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

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
        $providerName = Str::headline($this->provider->value);
        $appName = config('app.name');

        return (new MailMessage)
            ->subject('Изменения в учетной записи')
            ->greeting("Изменения в вашей учетной записи $appName")
            ->lineIf($this->type === self::CONNECTED, "Аккаунт $providerName успешно привязан в $appName.")
            ->lineIf($this->type === self::DISCONNECTED, "Аккаунт $providerName успешно отвязан в $appName.")
            ->line('Если вы ничего не изменяли, рекомендуется поменять пароль.')
            ->salutation(new HtmlString("С уважением,<br>$appName"));
    }
}
