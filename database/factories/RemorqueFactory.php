<?php

namespace Database\Factories;

use App\Models\Remorque;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RemorqueFactory extends Factory
{
    protected $model = Remorque::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->remorqueur()->create()->id,
            'type' => fake()->randomElement(['plateau', 'porte-voiture', 'bras']),
            'capacity' => fake()->randomFloat(2, 1, 10) . ' tonnes',
            'immatriculation' => fake()->bothify('??-####-??'),
            'photo' => null,
            'informations' => fake()->sentence(),
        ];
    }
}
