<?php

namespace App\Notifications\Auth;

use App\Enums\Auth\OAuthProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

final class Registration extends Notification implements ShouldQueue
{
    use Queueable;

    private const USUAL = 'usual';

    private const OAUTH = 'oauth';

    private ?OAuthProvider $provider = null;

    private ?string $password = null;

    private string $type;

    public function __construct()
    {
        $this->type = self::USUAL;
    }

    public static function oAuth(OAuthProvider $provider, string $password): Registration
    {
        $self = new Registration;
        $self->type = self::OAUTH;
        $self->provider = $provider;
        $self->password = $password;

        return $self;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $provider = Str::headline($this->provider->value);
        $appName = config('app.name');

        return (new MailMessage)
            ->subject("Регистрация $appName")
            ->greeting('Благодарим за регистрацию!')
            ->linesIf($this->type === self::OAUTH, [
                "Ваш пароль: $this->password",
                "Вы успешно авторизовались через $provider.",
                'Для Вас был автоматически сгенерирован временный пароль. Рекомендуется поменять его через настройки аккаунта.',
            ])
            ->salutation(new HtmlString("С уважением,<br>$appName"));
    }
}
