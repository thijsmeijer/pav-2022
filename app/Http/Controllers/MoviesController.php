<?php

namespace App\Http\Controllers;

use App\Helpers\MoviesHelper;
use App\Models\PopularMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class MoviesController extends Controller
{
    public function __invoke(Request $request)
    {
        if (request()->search) {
            $movies = Http::get(config('services.tmdb.url').'search/movie', [
                'api_key' => config('services.tmdb.api_key'),
                'language' => 'en-US',
                'page' => 1,
                'query' => request()->search,
            ])->json()['results'];

            $movies = MoviesHelper::addPostersUrl($movies);
        } else {
            $movies = MoviesHelper::addPosters(PopularMovie::all());
        }

        return Inertia::render('Search', [
            'movies' => $movies,
            'search' => request()->search,
        ]);
    }
}
