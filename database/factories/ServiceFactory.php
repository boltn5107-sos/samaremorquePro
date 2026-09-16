<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Remorquage',
                'Depannage batterie',
                'Depannage crevaison',
                'Depannage demarrage',
                'Panne mecanique',
                'Transport vehicule',
                'Autre',
            ]),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
