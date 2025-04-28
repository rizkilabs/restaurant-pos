<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'product_name' => 'Nasi Goreng Spesial',
                'product_price' => 25000,
                'product_photo' => 'products/nasi-goreng.jpg',
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'product_name' => 'Mie Ayam Bakso',
                'product_price' => 20000,
                'product_photo' => 'products/mie-ayam.jpg',
                'stock' => 40,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'product_name' => 'Es Teh Manis',
                'product_price' => 5000,
                'product_photo' => 'products/es-teh.jpg',
                'stock' => 100,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'product_name' => 'Jus Alpukat',
                'product_price' => 15000,
                'product_photo' => 'products/jus-alpukat.jpg',
                'stock' => 30,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
