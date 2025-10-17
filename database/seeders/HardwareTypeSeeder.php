<?php

namespace Database\Seeders;

use App\Models\HardwareType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HardwareTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Desktop', 'slug' => 'desktop', 'sort_order' => 1],
            ['name' => 'Laptop', 'slug' => 'laptop', 'sort_order' => 2],
            ['name' => 'Tablet', 'slug' => 'tablet', 'sort_order' => 3],
            ['name' => 'Android', 'slug' => 'android', 'sort_order' => 4],
            ['name' => 'iPhone', 'slug' => 'iphone', 'sort_order' => 5],
            ['name' => 'Server', 'slug' => 'server', 'sort_order' => 6],
            ['name' => 'Printer', 'slug' => 'printer', 'sort_order' => 7],
            ['name' => 'Router', 'slug' => 'router', 'sort_order' => 8],
            ['name' => 'Switch', 'slug' => 'switch', 'sort_order' => 9],
        ];

        foreach ($types as $type) {
            HardwareType::updateOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }
    }
}

