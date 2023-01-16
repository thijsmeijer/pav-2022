<?php

namespace App\Console\Commands;

use App\Jobs\SyncPopularMoviesJob;
use App\Services\MovieService;
use Illuminate\Console\Command;

class GetPopularMoviesCommand extends Command
{
    protected $signature = 'movies:get-popular';

    protected $description = 'get the most popular movies of today';

    public function handle(MovieService $movie)
    {
        SyncPopularMoviesJob::dispatch($movie->findPopularMovies());
    }
}
