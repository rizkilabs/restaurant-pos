<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::first(); // pastikan product sudah ada

        foreach (Order::all() as $order) {
            $qty = rand(1, 5);
            $price = $product->product_price;

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'order_price' => $price,
                'qty' => $qty,
                'order_subtotal' => $qty * $price,
            ]);
        }
    }
}
