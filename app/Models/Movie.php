<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    protected $casts = [
        'release_date' => 'date',
    ];

    public function lists(): belongsToMany
    {
        return $this->belongsToMany(UserList::class)->withTimestamps();
    }
}
