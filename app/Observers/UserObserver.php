<?php

namespace App\Observers;

use App\Events\User\Created as UserCreated;
use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        event(new UserCreated($user));

        $user->profile()->create();
    }

    public function updated(User $user): void
    {
        if ($user->isDirty('email')) {
            $user->sendEmailVerificationNotification();

            $user->updateQuietly([
                'email_verified_at' => null,
            ]);
        }
    }
}
