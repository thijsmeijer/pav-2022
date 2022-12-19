<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'username' => 'pav',
            'email' => config('auth.filament.user.email'),
            'password' => bcrypt(config('auth.filament.user.password')),
        ]);

        Profile::factory()
            ->for($user)
            ->create();
    }
}
