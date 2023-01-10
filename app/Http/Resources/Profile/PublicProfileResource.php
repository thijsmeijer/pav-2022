<?php

namespace App\Http\Resources\Profile;

use App\Http\Resources\Lists\ListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'username' => $this->username,
            'lists' => ListResource::collection($this->lists),
        ];
    }
}
