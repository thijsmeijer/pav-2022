<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lists\ListProfileResource;
use App\Models\User;
use Inertia\Inertia;

class PublicListController extends Controller
{
    public function index(User $user)
    {
        return Inertia::render('Lists/Index', [
            'profile' => new ListProfileResource($user),
        ]);
    }
}
