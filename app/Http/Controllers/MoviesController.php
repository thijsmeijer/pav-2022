<?php

namespace App\Http\Controllers;

use App\Helpers\MoviesHelper;
use App\Models\PopularMovie;
use App\Services\MovieService;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class MoviesController extends Controller
{
    public function __construct(
        public MovieService $movie,
    ) {
    }

    public function index(): InertiaResponse
    {
        $movies = request()->search
            ? $this->movie->searchMovies(request()->search)
            : MoviesHelper::addPosters(PopularMovie::all());

        return Inertia::render('Movies/Index', [
            'movies' => $movies,
            'search' => request()->search,
        ]);
    }

    public function show(int $id): InertiaResponse
    {
        return Inertia::render('Movies/Show', [
            'movie' => $this->movie->findMovie($id),
        ]);
    }
}
