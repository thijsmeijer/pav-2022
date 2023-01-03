<?php

namespace Database\Seeders;

use App\Models\UserList;
use Illuminate\Database\Seeder;

class UserListSeeder extends Seeder
{
    public function run(): void
    {
        $lists = UserList::factory(10)->create([
            'user_id' => config('auth.filament.user.id'),
        ]);

        $lists->each(function (UserList $list) {
            $list
                ->addMedia(public_path('images/list.png'))
                ->preservingOriginal()
                ->toMediaCollection('thumbnails', 'media.thumbnails');
        });
    }
}
