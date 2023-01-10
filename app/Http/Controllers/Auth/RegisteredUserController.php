<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly UserService $user
    ) {
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Auth/Register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = $this->user->create($request->validated());

        Auth::login($user);

        return redirect(RouteServiceProvider::PROFILE);
    }
}
