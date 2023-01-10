<?php

namespace App\Http\Resources\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
        ];
    }
}
