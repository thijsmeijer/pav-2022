<?php

namespace App\Observers;

use App\Models\Profile;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ProfileObserver
{
    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function created(Profile $profile): void
    {
        $profile
            ->addMedia(public_path('images/user.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('avatars', 'media.avatars');
    }
}
