<?php

namespace App\Console\Commands;

use App\Jobs\SyncPopularMoviesJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetPopularMoviesCommand extends Command
{
    protected $signature = 'movies:get-popular';

    protected $description = 'get the most popular movies of today';

    public function handle()
    {
        $movies = $this->getMoviesFromApi();

        SyncPopularMoviesJob::dispatch($movies);
    }

    public function getMoviesFromApi(): array
    {
        return Http::get(config('services.tmdb.url').'movie/popular', [
            'api_key' => config('services.tmdb.api_key'),
            'language' => 'en-US',
            'page' => 1,
        ])
            ->json()['results'];
    }
}
