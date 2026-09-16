<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->client()->create()->id,
            'type' => fake()->randomElement(['voiture', 'moto', 'camion', 'bus', 'autre']),
            'brand' => fake()->word(),
            'model' => fake()->word(),
            'plate_number' => fake()->bothify('??-####-??'),
            'color' => fake()->colorName(),
        ];
    }
}
