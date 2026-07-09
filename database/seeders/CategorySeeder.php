<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Perangkat elektronik seperti laptop, monitor, printer, dll.'],
            ['name' => 'Furniture', 'description' => 'Meja, kursi, lemari, dan perabotan kantor lainnya.'],
            ['name' => 'Alat Tulis Kantor (ATK)', 'description' => 'Pulpen, kertas, tinta printer, dan perlengkapan tulis lainnya.'],
            ['name' => 'Jaringan', 'description' => 'Router, switch, kabel LAN, dan perangkat jaringan.'],
            ['name' => 'Perlengkapan Rapat', 'description' => 'Proyektor, wireless presenter, papan tulis, dll.'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
