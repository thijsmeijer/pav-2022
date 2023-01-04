<?php

namespace App\Interfaces;

use App\Models\UserList;
use Illuminate\Http\UploadedFile;

interface ListRepositoryInterface
{
    public function create(array $data);

    public function update(UserList $list, array $data);

    public function updateThumbnail(UserList $list, UploadedFile $thumbnail);
}
