<?php

namespace App\Observers;

use App\Events\User\Created as UserCreated;
use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        $user->profile()->create();

        event(new UserCreated($user));
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
