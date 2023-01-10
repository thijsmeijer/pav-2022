<?php

namespace App\Http\Controllers;

use App\Helpers\MoviesHelper;
use App\Models\PopularMovie;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Home', [
            'movies' => MoviesHelper::addPosters(PopularMovie::all()),
        ]);
    }
}
