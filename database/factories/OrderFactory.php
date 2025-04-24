<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $amount = $this->faker->numberBetween(20000, 150000);
        $change = $this->faker->boolean(70) ? $this->faker->numberBetween(0, 10000) : 0;

        return [
            'order_code' => strtoupper('ORD-' . $this->faker->unique()->numerify('#####')),
            'order_detail' => $this->faker->sentence(),
            'order_amount' => $amount,
            'order_status' => $this->faker->randomElement(['pending', 'paid', 'cancelled']),
            'order_change' => $change,
        ];
    }
}
