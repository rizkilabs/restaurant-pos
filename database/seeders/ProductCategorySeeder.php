<?php

namespace Database\Seeders;
use App\Models\ProductCategory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Makanan Pembuka',
            'Makanan Utama',
            'Makanan Penutup',
            'Minuman Dingin',
            'Minuman Hangat',
            'Menu Sarapan',
            'Menu Anak-anak',
            'Makanan Spesial Mingguan',
            'Makanan Vegetarian',
            'Paket Hemat',
        ];

        foreach ($categories as $name) {
            ProductCategory::create(['name' => $name]);
        }
    }
}
