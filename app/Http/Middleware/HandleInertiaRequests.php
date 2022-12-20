<?php

namespace App\Http\Middleware;

use App\Http\Resources\Profile\UserResource;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth.user' => fn () => $request->user()
                ? new UserResource($request->user())
                : null,
            'avatar' => fn () => $request->user()
                ? $request->user()->profile->getMedia('avatars')->first()->getUrl()
                : null,
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'status' => fn () => $request->session()->get('status'),
            'flash' => fn () => $request->session()->get('flash'),
        ]);
    }
}
