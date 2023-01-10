<?php

namespace App\Listeners;

use App\Events\User\UserCreated;

class AddAvatarToUser
{
    public function handle(UserCreated $event): void
    {
        $event->user->profile
            ->addMedia(public_path('images/user.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('avatars', 'media.avatars');
    }
}
