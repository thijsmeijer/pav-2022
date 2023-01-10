<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use App\Http\Resources\Profile\PublicProfileResource;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PublicListController extends Controller
{
    public function index(User $user): InertiaResponse
    {
        return Inertia::render('Lists/Public/Index', [
            'profile' => new PublicProfileResource($user),
        ]);
    }
}
