<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_number' => $this->faker->unique()->numerify('ORD###'),
            'order_date_created' => $this->faker->dateTime(),
            'total_price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
