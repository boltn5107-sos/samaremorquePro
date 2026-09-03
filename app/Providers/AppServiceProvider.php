<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)
                ->subject('Reinitialisation du mot de passe')
                ->line('Vous recevez ce message car nous avons recu une demande de reinitialisation de mot de passe.')
                ->action('Reinitialiser le mot de passe', url(route('password.reset', $token, false)))
                ->line('Si vous n avez pas fait cette demande, ignorez ce message.');
        });

        View::composer('*', function ($view) {
            $view->with('appName', config('app.name'));
        });
    }
}
