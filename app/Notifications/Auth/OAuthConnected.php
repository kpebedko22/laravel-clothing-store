<?php

namespace App\Notifications\Auth;

use App\Enums\Auth\OAuthProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

final class OAuthConnected extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly OAuthProvider $provider)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $providerName = Str::headline($this->provider->value);
        $appName = config('app.name');

        return (new MailMessage)
            ->subject('Изменения в учетной записи')
            ->greeting("Аккаунт $providerName успешно привязан в $appName")
            ->salutation(new HtmlString("С уважением,<br>$appName"));
    }
}
