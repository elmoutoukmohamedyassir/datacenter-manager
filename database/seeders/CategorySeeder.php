<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'name' => 'Servers',
            'description' => 'Rack servers and blade servers'
        ]);

        Category::create([
            'name' => 'Networking',
            'description' => 'Switches, routers, and firewalls'
        ]);

        Category::create([
            'name' => 'Peripherals',
            'description' => 'Keyboards, mice, and monitors'
        ]);
    }
}
