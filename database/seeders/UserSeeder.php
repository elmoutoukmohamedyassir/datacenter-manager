<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@datacenter.com',
            'password' => Hash::make('password'), // Password is 'password'
            'role_id' => 1, // Points to 'admin' role
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Technician Bob',
            'email' => 'tech@datacenter.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Points to 'manager' role
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Professor Charlie',
            'email' => 'user@datacenter.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Points to 'user' role
            'is_active' => true,
        ]);
    }
}
