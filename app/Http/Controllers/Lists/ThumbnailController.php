<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lists\UpdateThumbnailRequest;
use App\Models\UserList;
use App\Repositories\ListRepository;

class ThumbnailController extends Controller
{
    public function __construct(
        public ListRepository $list,
    ) {
    }

    public function update(UpdateThumbnailRequest $request, UserList $list)
    {
        if ($request->hasFile('thumbnail')) {
            $this->list->updateThumbnail($list, $request->file('thumbnail'));
        }

        return redirect()->route('lists.edit', $list);
    }
}
