<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Harian: 10 data untuk hari ini
        for ($i = 1; $i <= 10; $i++) {
            Order::create([
                'order_code' => 'ORD-HARIAN-' . $i,
                'order_amount' => rand(50000, 150000),
                'order_change' => rand(1000, 20000),
                'order_status' => 'PAID',
                'created_at' => Carbon::now(),
            ]);
        }

        // Mingguan: 10 data antara 1–7 hari yang lalu
        for ($i = 1; $i <= 10; $i++) {
            Order::create([
                'order_code' => 'ORD-MINGGUAN-' . $i,
                'order_amount' => rand(50000, 150000),
                'order_change' => rand(1000, 20000),
                'order_status' => 'PAID',
                'created_at' => Carbon::now()->subDays(rand(1, 7)),
            ]);
        }

        // Bulanan: 10 data antara 8–30 hari yang lalu
        for ($i = 1; $i <= 10; $i++) {
            Order::create([
                'order_code' => 'ORD-BULANAN-' . $i,
                'order_amount' => rand(50000, 150000),
                'order_change' => rand(1000, 20000),
                'order_status' => 'PAID',
                'created_at' => Carbon::now()->subDays(rand(8, 30)),
            ]);
        }
    }
}
