<?php

namespace App\Http\Resources\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class ListProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'username' => $this->username,
            'lists' => ListIndexResource::collection($this->lists),
        ];
    }
}
