<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Notifications\Welcome;

class SendWelcomeNotification
{
    public function handle(UserCreated $event): void
    {
        $event->user->notify(new Welcome($event->user));
    }
}
