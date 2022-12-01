<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'pav',
            'email' => config('auth.filament.user.email'),
            'password' => bcrypt(config('auth.filament.user.password')),
        ]);

        User::factory(10)->create();
    }
}
