<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@datacenter.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Manager
        User::create([
            'name' => 'Resource Manager',
            'email' => 'manager@datacenter.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        // 3. Technician
        User::create([
            'name' => 'Hardware Tech',
            'email' => 'tech@datacenter.com',
            'password' => Hash::make('password'),
            'role' => 'technician',
        ]);

        // 4. Standard User
        User::create([
            'name' => 'Standard User',
            'email' => 'user@datacenter.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}