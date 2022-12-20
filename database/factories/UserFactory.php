<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'username' => fake()->userName,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$TaPnYDprJ7esf/uD.2tSAeUYBfzXc2uRewCGwnoYMU18F4t4mUerW', // secret
            'remember_token' => Str::random(10),
        ];
    }
}
