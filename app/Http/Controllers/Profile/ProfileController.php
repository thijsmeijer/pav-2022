<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\DestroyProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserService $user
    ) {
    }

    public function edit(): InertiaResponse
    {
        return Inertia::render('Profile/Edit');
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $this->user->update($request->validated());

        return Redirect::route('profile.edit');
    }

    public function destroy(DestroyProfileRequest $request): RedirectResponse
    {
        auth()->user()->forceDelete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to(RouteServiceProvider::HOME);
    }
}
