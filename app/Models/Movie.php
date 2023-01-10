<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Movie extends Model implements hasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'overview',
        'release_date',
        'rating',
        'tmdb_id',
        'poster_path',
    ];
}
