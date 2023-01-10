<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AvatarController extends Controller
{
    public function __construct(
        private readonly UserService $user
    ) {
    }

    public function update(UpdateAvatarRequest $request): RedirectResponse
    {
        if ($request->hasFile('avatar')) {
            $this->user->updateAvatar($request->file('avatar'));
        }

        return Redirect::route('profile.edit');
    }
}
