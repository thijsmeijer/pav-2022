<?php

namespace App\Listeners;

use App\Events\User\UserCreated;
use App\Notifications\Welcome as WelcomeUser;

class SendWelcomeNotification
{
    public function handle(UserCreated $event): void
    {
        $event->user->notify(new WelcomeUser($event->user));

        $event->user->sendEmailVerificationNotification();
    }
}
