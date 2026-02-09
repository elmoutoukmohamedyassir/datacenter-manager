<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;
use App\Models\Category;
use App\Models\User;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get the IDs we need to link the resource
        $serverCat = Category::where('name', 'Servers')->first();
        $adminUser = User::where('role', 'admin')->first() ?? User::first();

        // 2. Create a high-end server resource
        Resource::create([
            'name' => 'Dell PowerEdge R740',
            'type' => 'Physical Server',
            'cpu' => 'Intel Xeon Gold 6230',
            'ram' => '256GB DDR4',
            'os' => 'Proxmox VE 8.1',
            'location' => 'Data Center A - Rack 04',
            'category_id' => $serverCat->id,
            'manager_id' => $adminUser->id,
            'specifications' => json_encode(['storage' => '2TB NVMe', 'network' => '10Gbps']),
            'status' => 'disponible',
            'is_active' => true,
        ]);

        // 3. Create a networking resource
        $netCat = Category::where('name', 'Networking')->first();
        Resource::create([
            'name' => 'Cisco Nexus 9000',
            'type' => 'Switch',
            'cpu' => 'N/A',
            'ram' => '32GB',
            'os' => 'NX-OS',
            'location' => 'Data Center A - Rack 01',
            'category_id' => $netCat->id,
            'manager_id' => $adminUser->id,
            'specifications' => json_encode(['ports' => '48x10G SFP+']),
            'status' => 'maintenance', // Testing the maintenance status
            'is_active' => true,
        ]);
    }
}