<?php

namespace App\Events\List;

use App\Models\UserList;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;

class ListCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public UserList $list,
        public ?UploadedFile $thumbnail,
    ) {
    }
}
