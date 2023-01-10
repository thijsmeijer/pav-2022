<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $movies = Http::get(config('services.tmdb.url').'movie/popular?api_key='.config('services.tmdb.api_key'))->json();

        return Inertia::render('Home', [
            'movies' => $movies['results'],
        ]);
    }
}
