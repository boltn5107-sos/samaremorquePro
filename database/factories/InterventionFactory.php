<?php

namespace Database\Factories;

use App\Models\Intervention;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterventionFactory extends Factory
{
    protected $model = Intervention::class;

    public function definition(): array
    {
        return [
            'client_id' => User::factory()->client()->create()->id,
            'professional_id' => User::factory()->remorqueur()->create()->id,
            'vehicle_id' => Vehicle::factory()->create()->id,
            'service_type' => fake()->randomElement(['remorquage', 'depannage']),
            'description' => fake()->sentence(),
            'photo' => null,
            'status' => Intervention::STATUS_AWAITING_PROFESSIONAL,
            'client_lat' => fake()->randomFloat(7, 14.6, 14.8),
            'client_lng' => fake()->randomFloat(7, -17.6, -17.3),
            'client_address' => fake()->address(),
            'destination' => fake()->address(),
            'destination_lat' => fake()->randomFloat(7, 14.6, 14.8),
            'destination_lng' => fake()->randomFloat(7, -17.6, -17.3),
            'distance_km' => fake()->randomFloat(2, 1, 50),
            'estimated_duration_minutes' => fake()->numberBetween(15, 120),
            'client_manual_position' => null,
        ];
    }
}
