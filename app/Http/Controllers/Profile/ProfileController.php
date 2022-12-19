<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileDestroyRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Http\Resources\Profile\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function edit(): Response
    {
        return Inertia::render('Profile/Edit',
            [
                'user' => new UserResource(Auth::user()),
            ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->userRepository->updateUser($request->user(), $request->validated());

        return Redirect::route('profile.edit');
    }

    public function destroy(ProfileDestroyRequest $request): RedirectResponse
    {
        $request->user()->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::logout();

        return Redirect::to('/');
    }
}
