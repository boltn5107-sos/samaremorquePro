<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Depanneur;
use App\Models\Remorqueur;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $client = User::firstOrCreate(
            ['email' => 'client@senegaltowing.sn'],
            [
                'first_name' => 'Client',
                'last_name' => 'Test',
                'phone' => '+221771234568',
                'password' => Hash::make('password'),
                'role' => 'client',
                'email_verified_at' => now(),
            ]
        );

        Client::firstOrCreate(['user_id' => $client->id]);

        $remorqueur = User::firstOrCreate(
            ['email' => 'remorqueur@senegaltowing.sn'],
            [
                'first_name' => 'Remorqueur',
                'last_name' => 'Test',
                'phone' => '+221771234569',
                'password' => Hash::make('password'),
                'role' => 'remorqueur',
                'zone_intervention' => 'Dakar, Senegal',
                'is_validated' => true,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        Remorqueur::firstOrCreate(['user_id' => $remorqueur->id]);

        $depanneur = User::firstOrCreate(
            ['email' => 'depanneur@senegaltowing.sn'],
            [
                'first_name' => 'Depanneur',
                'last_name' => 'Test',
                'phone' => '+221771234570',
                'password' => Hash::make('password'),
                'role' => 'depanneur',
                'zone_intervention' => 'Dakar, Senegal',
                'is_validated' => true,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        Depanneur::firstOrCreate(['user_id' => $depanneur->id]);

        User::whereNull('email_verified_at')->update(['email_verified_at' => now()]);
    }
}
