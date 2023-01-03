<?php

namespace App\Repositories;

use App\Enums\ListStatus;
use App\Interfaces\ListRepositoryInterface;
use App\Models\UserList;

class ListRepository implements ListRepositoryInterface
{

    public function create(array $data)
    {
        $list = UserList::create([
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'excerpt' => $data['excerpt'],
            'description' => $data['description'],
            'status' => ListStatus::Private
        ]);

        $list
            ->addMedia($data['thumbnail'] ?? public_path('images/list.png'))
            ->preservingOriginal()
            ->toMediaCollection('thumbnails', 'media.thumbnails');
    }
}
