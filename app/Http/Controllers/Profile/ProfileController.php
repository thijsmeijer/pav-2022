<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileDestroyRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Http\Resources\Profile\UserResource;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserRepository $user
    ) {
    }

    public function edit(): InertiaResponse
    {
        return Inertia::render('Profile/Edit');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->user->update(auth()->user(), $request->validated());

        return Redirect::route('profile.edit');
    }

    public function destroy(ProfileDestroyRequest $request): RedirectResponse
    {
        $this->user->delete(auth()->user());

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to(RouteServiceProvider::HOME);
    }
}
