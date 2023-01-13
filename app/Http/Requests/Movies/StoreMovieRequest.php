<?php

namespace App\Http\Requests\Movies;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tmdb_id' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'excerpt' => ['nullable', 'string'],
            'overview' => ['required', 'string'],
            'release_date' => ['required', 'date'],
            'rating' => ['required', 'numeric'],
            'poster_path' => ['required', 'string'],
        ];
    }
}
