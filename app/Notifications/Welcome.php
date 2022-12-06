<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Welcome extends Notification
{
    use Queueable;

    public function __construct(
        public readonly User $user
    ) {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Welcome to PAV!')
                    ->greeting('Hello, '.$this->user->username.'!')
                    ->line('Thank you for signing up for PAV. We hope you enjoy your stay.')
                    ->action('View your profile', route('profile.edit'))
                    ->line('Thank you for using our application!');
    }
}
