<?php

namespace App\Services;

use App\Enums\ListStatus;
use App\Events\List\ListCreated;
use App\Models\UserList;
use Illuminate\Http\UploadedFile;

class ListService
{
    public function create(array $data): void
    {
        $list = UserList::create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'excerpt' => $data['excerpt'],
            'description' => $data['description'],
            'status' => ListStatus::Private,
        ]);

        ListCreated::dispatch($list, $data['thumbnail']);
    }

    public function update(UserList $list, array $data): void
    {
        $list->update([
            'name' => $data['name'],
            'excerpt' => $data['excerpt'],
            'description' => $data['description'],
            'status' => ListStatus::from($data['status']),
        ]);
    }

    public function updateThumbnail(UserList $list, UploadedFile $thumbnail): void
    {
        $list
            ->clearMediaCollection('thumbnails')
            ->addMedia($thumbnail)
            ->toMediaCollection('thumbnails', 'media.thumbnails');
    }
}
