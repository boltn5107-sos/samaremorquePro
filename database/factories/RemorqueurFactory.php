<?php

namespace Database\Factories;

use App\Models\Remorqueur;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RemorqueurFactory extends Factory
{
    protected $model = Remorqueur::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->remorqueur(),
            'license_number' => fake()->bothify('??-####'),
            'experience_years' => fake()->numberBetween(1, 20),
            'hourly_rate' => fake()->randomFloat(2, 5000, 50000),
            'is_available' => true,
        ];
    }
}
