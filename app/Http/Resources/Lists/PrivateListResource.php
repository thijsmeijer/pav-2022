<?php

namespace App\Http\Resources\Lists;

class PrivateListResource extends ListResource
{
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'status' => $this->status,
        ]);
    }
}
