<?php

namespace App\Http\Resources\Movies;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'tmdb_id' => $this->tmdb_id,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'overview' => $this->overview,
            'release_date' => $this->release_date,
            'rating' => $this->rating,
            'poster_path' => $this->poster_path,
        ];
    }
}
