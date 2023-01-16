<?php

namespace App\Http\Resources\Lists;

use App\Http\Resources\Movies\MovieResource;

class PrivateListResource extends ListResource
{
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'status' => $this->status,
            'movies' => MovieResource::collection($this->movies),
        ]);
    }
}
