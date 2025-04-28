<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'order_code' => 'ORD-2025001',
                'order_detail' => '2x Burger, 1x Fries',
                'order_amount' => 75000,
                'order_status' => 'paid',
                'order_change' => 5000,
            ],
            [
                'order_code' => 'ORD-2025002',
                'order_detail' => '1x Pizza, 2x Soda',
                'order_amount' => 120000,
                'order_status' => 'pending',
                'order_change' => 0,
            ],
            [
                'order_code' => 'ORD-2025003',
                'order_detail' => '3x Coffee',
                'order_amount' => 45000,
                'order_status' => 'paid',
                'order_change' => 0,
            ],
            [
                'order_code' => 'ORD-2025004',
                'order_detail' => '1x Pasta, 1x Ice Cream',
                'order_amount' => 90000,
                'order_status' => 'cancelled',
                'order_change' => 0,
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
