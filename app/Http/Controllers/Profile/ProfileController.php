<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileDestroyRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Http\Resources\Profile\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\Response as InertiaResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function edit(): InertiaResponse
    {
        return Inertia::render('Profile/Edit',
            [
                'user' => new UserResource(Auth::user()),
            ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->userRepository->update($request->user(), $request->validated());

        return Redirect::route('profile.edit');
    }

    public function destroy(ProfileDestroyRequest $request): RedirectResponse
    {
        $this->userRepository->delete($request->user());

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
