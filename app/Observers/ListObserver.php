<?php

namespace App\Observers;

use App\Models\UserList;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ListObserver
{
    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function created(UserList $list): void
    {
        if (! $list->has_thumbnail) {
            $list
                ->addMedia(public_path('images/list.png'))
                ->preservingOriginal()
                ->toMediaCollection('thumbnails', 'media.thumbnails');
        }
    }
}
