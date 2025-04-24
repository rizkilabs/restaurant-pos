<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            // Ambil 2-4 produk acak untuk setiap order
            $orderProducts = $products->random(rand(2, 4));

            foreach ($orderProducts as $product) {
                $qty = rand(1, 5);
                $price = $product->product_price;
                $subtotal = $price * $qty;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'order_price' => $price,
                    'qty' => $qty,
                    'order_subtotal' => $subtotal,
                ]);
            }
        }
    }
}
