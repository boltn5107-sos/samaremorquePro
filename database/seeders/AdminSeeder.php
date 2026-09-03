<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@senegaltowing.sn'],
            [
                'first_name' => 'Admin',
                'last_name' => 'System',
                'phone' => '+221771234567',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_validated' => true,
                'is_active' => true,
            ]
        );

        Admin::firstOrCreate(
            ['user_id' => $user->id],
            ['permissions' => ['*']]
        );
    }
}
