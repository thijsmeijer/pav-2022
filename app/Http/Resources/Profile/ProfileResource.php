<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth ? $this->date_of_birth->format('Y-m-d') : null,
            'bio' => $this->bio,
            'phone' => $this->phone,
            'phone_verified_at' => $this->phone_verified_at ? $this->phone_verified_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
