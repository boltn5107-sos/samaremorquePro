<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'lat' => fake()->randomFloat(7, 14.6, 14.8),
            'lng' => fake()->randomFloat(7, -17.6, -17.3),
            'address' => fake()->address(),
            'recorded_at' => now(),
        ];
    }
}
