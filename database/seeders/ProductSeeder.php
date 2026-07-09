<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $elektronik = Category::where('name', 'Elektronik')->first();
        $furniture = Category::where('name', 'Furniture')->first();
        $atk = Category::where('name', 'Alat Tulis Kantor (ATK)')->first();
        $jaringan = Category::where('name', 'Jaringan')->first();
        $rapat = Category::where('name', 'Perlengkapan Rapat')->first();

        $products = [
            ['code' => 'ELK-001', 'name' => 'Laptop Dell Latitude 5520', 'category_id' => $elektronik->id, 'stock' => 15, 'minimum_stock' => 3, 'storage_location' => 'Gudang A - Rak 1', 'condition' => 'Baik'],
            ['code' => 'ELK-002', 'name' => 'Monitor LG 24 inch', 'category_id' => $elektronik->id, 'stock' => 20, 'minimum_stock' => 5, 'storage_location' => 'Gudang A - Rak 2', 'condition' => 'Baik'],
            ['code' => 'ELK-003', 'name' => 'Printer HP LaserJet Pro', 'category_id' => $elektronik->id, 'stock' => 5, 'minimum_stock' => 2, 'storage_location' => 'Gudang A - Rak 3', 'condition' => 'Baik'],
            ['code' => 'ELK-004', 'name' => 'Keyboard Logitech K120', 'category_id' => $elektronik->id, 'stock' => 30, 'minimum_stock' => 10, 'storage_location' => 'Gudang A - Rak 4', 'condition' => 'Baik'],
            ['code' => 'ELK-005', 'name' => 'Mouse Logitech B100', 'category_id' => $elektronik->id, 'stock' => 2, 'minimum_stock' => 10, 'storage_location' => 'Gudang A - Rak 4', 'condition' => 'Baik'],
            ['code' => 'FRN-001', 'name' => 'Meja Kerja 120x60cm', 'category_id' => $furniture->id, 'stock' => 25, 'minimum_stock' => 5, 'storage_location' => 'Gudang B - Area 1', 'condition' => 'Baik'],
            ['code' => 'FRN-002', 'name' => 'Kursi Kantor Ergonomis', 'category_id' => $furniture->id, 'stock' => 20, 'minimum_stock' => 5, 'storage_location' => 'Gudang B - Area 2', 'condition' => 'Baik'],
            ['code' => 'FRN-003', 'name' => 'Lemari Arsip 4 Laci', 'category_id' => $furniture->id, 'stock' => 8, 'minimum_stock' => 2, 'storage_location' => 'Gudang B - Area 3', 'condition' => 'Rusak Ringan'],
            ['code' => 'ATK-001', 'name' => 'Kertas A4 70gsm (Rim)', 'category_id' => $atk->id, 'stock' => 100, 'minimum_stock' => 20, 'storage_location' => 'Gudang C - Rak 1', 'condition' => 'Baik'],
            ['code' => 'ATK-002', 'name' => 'Tinta Printer HP 680 Black', 'category_id' => $atk->id, 'stock' => 1, 'minimum_stock' => 5, 'storage_location' => 'Gudang C - Rak 2', 'condition' => 'Baik'],
            ['code' => 'JRG-001', 'name' => 'Router Cisco RV340', 'category_id' => $jaringan->id, 'stock' => 3, 'minimum_stock' => 1, 'storage_location' => 'Gudang D - Rak 1', 'condition' => 'Baik'],
            ['code' => 'JRG-002', 'name' => 'Switch TP-Link 24 Port', 'category_id' => $jaringan->id, 'stock' => 5, 'minimum_stock' => 2, 'storage_location' => 'Gudang D - Rak 2', 'condition' => 'Dalam Perbaikan'],
            ['code' => 'RPT-001', 'name' => 'Proyektor Epson EB-X51', 'category_id' => $rapat->id, 'stock' => 4, 'minimum_stock' => 1, 'storage_location' => 'Ruang Rapat - Lemari 1', 'condition' => 'Baik'],
            ['code' => 'RPT-002', 'name' => 'Wireless Presenter Logitech R500', 'category_id' => $rapat->id, 'stock' => 6, 'minimum_stock' => 2, 'storage_location' => 'Ruang Rapat - Lemari 2', 'condition' => 'Baik'],
            ['code' => 'ELK-006', 'name' => 'UPS APC 1100VA', 'category_id' => $elektronik->id, 'stock' => 0, 'minimum_stock' => 3, 'storage_location' => 'Gudang A - Rak 5', 'condition' => 'Rusak Berat'],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(['code' => $product['code']], $product);
        }
    }
}
