<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'password' => bcrypt('password'),
            'role' => 'client',
            'photo' => null,
            'zone_intervention' => fake()->city(),
            'bio' => fake()->sentence(),
            'professional_info' => fake()->sentence(),
            'is_validated' => true,
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }

    public function client(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'client',
        ]);
    }

    public function remorqueur(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'remorqueur',
            'is_validated' => true,
        ]);
    }

    public function depanneur(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'depanneur',
            'is_validated' => true,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }
}
