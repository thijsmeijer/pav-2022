<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movies\StoreMovieRequest;
use App\Models\UserList;
use App\Services\MovieService;
use Illuminate\Http\RedirectResponse;
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
            : $this->movie->findPopularMovies();

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

    public function store(StoreMovieRequest $request, UserList $list): RedirectResponse
    {
        $this->movie->create($list, $request->validated());

        return redirect()
            ->back()
            ->with('success', "Movie added to '".$list->name."'")
            ->with('info', $list->name);
    }
}
