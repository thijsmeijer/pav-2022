<?php

namespace App\Http\Resources\Profile;

use App\Http\Resources\Lists\ListIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'profile' => new ProfileResource($this->profile),
            'lists' => ListIndexResource::collection($this->lists->sortByDesc('created_at')),
        ];
    }
}
