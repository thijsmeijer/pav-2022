<?php

namespace App\Http\Resources\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class ListIndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
        ];
    }
}
