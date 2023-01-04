<?php

namespace App\Repositories;

use App\Enums\ListStatus;
use App\Interfaces\ListRepositoryInterface;
use App\Models\UserList;
use Illuminate\Http\UploadedFile;

class ListRepository implements ListRepositoryInterface
{
    public function create(array $data)
    {
        $list = UserList::create([
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'excerpt' => $data['excerpt'],
            'description' => $data['description'],
            'status' => ListStatus::Private,
        ]);

        $list
            ->addMedia($data['thumbnail'] ?? public_path('images/list.png'))
            ->preservingOriginal()
            ->toMediaCollection('thumbnails', 'media.thumbnails');
    }

    public function update(UserList $list, array $data)
    {
        $list->update([
            'name' => $data['name'],
            'excerpt' => $data['excerpt'],
            'description' => $data['description'],
            'status' => ListStatus::from($data['status']),
        ]);
    }

    public function updateThumbnail(UserList $list, UploadedFile $thumbnail)
    {
        $list
            ->clearMediaCollection('thumbnails')
            ->addMedia($thumbnail)
            ->toMediaCollection('thumbnails', 'media.thumbnails');
    }
}
