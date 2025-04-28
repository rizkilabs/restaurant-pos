<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderDetails = [
            [
                'order_id' => 1,
                'product_id' => 2,
                'order_price' => 25000,
                'qty' => 2,
                'order_subtotal' => 50000,
            ],
            [
                'order_id' => 1,
                'product_id' => 3,
                'order_price' => 15000,
                'qty' => 1,
                'order_subtotal' => 15000,
            ],
            [
                'order_id' => 2,
                'product_id' => 4,
                'order_price' => 40000,
                'qty' => 1,
                'order_subtotal' => 40000,
            ],
            [
                'order_id' => 3,
                'product_id' => 1,
                'order_price' => 10000,
                'qty' => 3,
                'order_subtotal' => 30000,
            ],
        ];

        foreach ($orderDetails as $detail) {
            OrderDetail::create($detail);
        }
    }
}
