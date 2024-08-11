<?php

namespace Database\Factories;

use App\Enums\OrderStatuses;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'user_id' => User::factory()->create()->id,
           'total_price' => rand(2000000,20000000),
           'total_price_after_discount' => rand(2000000,20000000),
           'status' => OrderStatuses::randomValue()
        ];
    }
}
