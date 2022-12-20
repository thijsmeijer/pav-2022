<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-18 years'),
            'phone' => fake()->phoneNumber,
            'phone_verified_at' => null,
            'bio' => fake()->paragraph,
        ];
    }
}
