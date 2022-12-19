<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Listeners\SendWelcomeNotification;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserCreated::class => [
            SendWelcomeNotification::class,
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
