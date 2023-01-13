<?php

namespace App\Helpers;

class MoviesHelper
{
    public static function addPoster($movie): array
    {
        $movie->poster = $movie->getFirstMediaUrl('popular_posters');

        return $movie->toArray();
    }

    public static function addPosters($movies): array
    {
        return $movies->map(function ($movie) {
            return self::addPoster($movie);
        })->toArray();
    }

    public static function addPosterUrl($movie): array
    {
        $movie['poster'] = $movie['poster_path'] ? 'https://image.tmdb.org/t/p/original'.$movie['poster_path'] : 'https://via.placeholder.com/500x750';

        return $movie;
    }

    public static function addPostersUrl($movies): array
    {
        return collect($movies)->map(function ($movie) {
            return self::addPosterUrl($movie);
        })->toArray();
    }
}
