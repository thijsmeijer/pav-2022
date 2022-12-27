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
        // TODO: check if thumbnail is uploaded with list creation, only add the list image if no thumbnail is provided.
        $list
            ->addMedia(public_path('images/list.png'))
            ->preservingOriginal()
            ->toMediaCollection('thumbnails', 'media.thumbnails');
    }
}
