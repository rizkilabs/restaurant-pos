<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ProductCategory::all();

        if ($categories->isEmpty()) {
            $categories = ProductCategory::factory()->count(3)->create();
        }

        foreach ($categories as $category) {
            Product::factory()->count(5)->create([
                'category_id' => $category->id,
                'is_active' => true,
            ]);
        }
    }
}
