<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Listeners\SendWelcomeNotification;
use App\Models\Profile;
use App\Models\User;
use App\Observers\ProfileObserver;
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
        Profile::observe(ProfileObserver::class);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
