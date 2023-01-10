<?php

namespace Database\Seeders;

use App\Models\UserList;
use Illuminate\Database\Seeder;

class UserListSeeder extends Seeder
{
    public function run(): void
    {
        UserList::factory(10)->create([
            'user_id' => config('auth.filament.user.id'),
        ]);
    }
}
