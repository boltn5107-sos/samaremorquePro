<?php

namespace Database\Factories;

use App\Models\Depanneur;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepanneurFactory extends Factory
{
    protected $model = Depanneur::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->depanneur(),
            'license_number' => fake()->bothify('??-####'),
            'experience_years' => fake()->numberBetween(1, 20),
            'hourly_rate' => fake()->randomFloat(2, 5000, 50000),
            'is_available' => true,
        ];
    }
}
