<?php

namespace App\Services;

use App\Helpers\MoviesHelper;
use App\Models\UserList;
use Illuminate\Support\Facades\Http;

class MovieService
{
    public function findMovie(int $id): array
    {
        $movie = Http::get(config('services.tmdb.url').'movie/'.$id, [
            'api_key' => config('services.tmdb.api_key'),
            'language' => 'en-US',
        ])->json();

        return MoviesHelper::addPosterUrl($movie);
    }

    public function findPopularMovies(): array
    {
        $movies = Http::get(config('services.tmdb.url').'movie/popular', [
            'api_key' => config('services.tmdb.api_key'),
            'language' => 'en-US',
            'page' => 1,
        ])->json()['results'];

        return MoviesHelper::addPostersUrl($movies);
    }

    public function searchMovies(string $query): array
    {
        $movies = Http::get(config('services.tmdb.url').'search/movie', [
            'api_key' => config('services.tmdb.api_key'),
            'language' => 'en-US',
            'page' => 1,
            'query' => $query,
        ])->json()['results'];

        return MoviesHelper::addPostersUrl($movies);
    }

    public function create(UserList $list, array $data): void
    {
        $list->movies()->create($data);
    }
}
