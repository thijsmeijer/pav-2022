<?php

namespace App\Http\Controllers;

use App\Models\PopularMovie;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $popularMovies = PopularMovie::all();

        $popularMovies->each(function (PopularMovie $popularMovie) {
            $popularMovie->poster = $popularMovie->getFirstMediaUrl('posters');
        });

        return Inertia::render('Home', [
            'movies' => $popularMovies,
        ]);
    }
}
