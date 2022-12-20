<?php

namespace App\Listeners;

use App\Events\User\Created;
use App\Notifications\Welcome as WelcomeUser;

class SendWelcomeNotification
{
    public function handle(Created $event): void
    {
        $event->user->notify(new WelcomeUser($event->user));
    }
}
