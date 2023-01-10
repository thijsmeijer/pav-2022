<?php

namespace App\Http\Controllers;

use App\Models\PopularMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class SearchController extends Controller
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

            $movies = collect($movies)->map(function ($movie) {
                $movie['poster'] = $movie['poster_path'] ? 'https://image.tmdb.org/t/p/original/'.$movie['poster_path'] : 'https://via.placeholder.com/500x750';

                return $movie;
            });
        } else {
            $movies = PopularMovie::all();

            $movies->each(function (PopularMovie $movie) {
                $movie->poster = $movie->getFirstMediaUrl('posters');
            });
        }

        return Inertia::render('Search', [
            'movies' => $movies,
            'search' => request()->search,
        ]);
    }
}
