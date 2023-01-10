<?php

namespace App\Listeners;

use App\Enums\ListStatus;
use App\Events\User\UserCreated;

class AddDefaultListsToUser
{
    public function handle(UserCreated $event): void
    {
        $lists = $event->user->lists()->createMany([
            [
                'name' => 'Watched',
                'description' => 'Movies i watched',
                'status' => ListStatus::Private,
            ],
            [
                'name' => 'Watching',
                'description' => 'Movies i am currently watching',
                'status' => ListStatus::Private,
            ],
            [
                'name' => 'Plan to watch',
                'description' => 'Movies you want to watch',
                'status' => ListStatus::Private,
            ],
            [
                'name' => 'Favorites',
                'description' => 'Movies i like the most',
                'status' => ListStatus::Private,
            ],
        ]);

        $lists->each(function ($list) {
            $list->addMedia(public_path('images/list.png'))
                ->preservingOriginal()
                ->toMediaCollection('thumbnails', 'media.thumbnails');
        });
    }
}
