<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Repositories\ProfileRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AvatarController extends Controller
{
    public function __construct(
        private readonly ProfileRepository $profile
    ) {
    }

    public function update(UpdateAvatarRequest $request): RedirectResponse
    {
        if ($request->hasFile('avatar')) {
            $this->profile->updateAvatar($request->user(), $request->file('avatar'));
        }

        return Redirect::route('profile.edit');
    }
}
