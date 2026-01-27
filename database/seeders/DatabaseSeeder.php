<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call our custom seeders in the correct order
        $this->call([
            RoleSeeder::class,      // 1. Create Admin, Manager, User roles
            UserSeeder::class,      // 2. Create the actual accounts assigned to those roles
            CategorySeeder::class,  // 3. Create resource categories (Electronics, etc.)
        ]);
    }
}
