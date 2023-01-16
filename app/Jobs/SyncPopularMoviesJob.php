<?php

namespace App\Jobs;

use App\Models\PopularMovie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncPopularMoviesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public array $movies
    ) {
    }

    public function handle(): void
    {
        PopularMovie::all()->each->delete();

        $this->syncMovies();
    }

    private function syncMovies(): void
    {
        foreach ($this->movies as $movie) {
            $newMovie = PopularMovie::create([
                'title' => $movie['title'],
                'tmdb_id' => $movie['id'],
                'poster_path' => $movie['poster_path'],
            ]);

            $this->storePoster($newMovie);
        }
    }

    private function storePoster(PopularMovie $movie): void
    {
        $movie
            ->addMediaFromUrl('https://image.tmdb.org/t/p/original'.$movie->poster_path)
            ->toMediaCollection('popular_posters', 'media.movies.popular');
    }
}
