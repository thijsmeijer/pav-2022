<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PrivateListController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Lists/Private/Index');
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Lists/Private/Create');
    }
}
