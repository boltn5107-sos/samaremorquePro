<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            return;
        }

        $services = [
            'Remorquage',
            'Depannage batterie',
            'Depannage crevaison',
            'Depannage demarrage',
            'Panne mecanique',
            'Transport vehicule',
            'Autre',
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['user_id' => $admin->id, 'name' => $service],
                [
                    'description' => 'Service de ' . strtolower($service),
                    'is_active' => true,
                ]
            );
        }
    }
}
