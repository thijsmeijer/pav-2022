<?php

namespace App\Providers;

use App\Events\List\ListCreated;
use App\Events\User\UserCreated;
use App\Listeners\AddAvatarToUser;
use App\Listeners\AddDefaultListsToUser;
use App\Listeners\AddThumbnailToList;
use App\Listeners\SendWelcomeNotification;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserCreated::class => [
            AddAvatarToUser::class,
            AddDefaultListsToUser::class,
            SendWelcomeNotification::class,
        ],
        ListCreated::class => [
            AddThumbnailToList::class,
        ],
    ];

    public function boot()
    {
        JsonResource::withoutWrapping();

        User::observe(UserObserver::class);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
