<?php

namespace Database\Factories;

use App\Enums\ListStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserListFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->name,
            'excerpt' => fake()->sentence,
            'description' => fake()->text,
            'status' => fake()->randomElement(ListStatus::cases()),
        ];
    }
}
