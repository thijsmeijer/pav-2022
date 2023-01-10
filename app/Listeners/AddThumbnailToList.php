<?php

namespace App\Listeners;

use App\Events\List\ListCreated;

class AddThumbnailToList
{
    public function handle(ListCreated $event): void
    {
        $event->list
            ->addMedia($event->thumbnail ?? public_path('images/list.png'))
            ->preservingOriginal()
            ->toMediaCollection('thumbnails', 'media.thumbnails');
    }
}
