<?php

namespace Database\Factories;

use App\Enums\ProductType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory()->create()->id,
            'orderable_id' => Product::factory()->create()->id,
            'orderable_type' => Product::class,
            'unit_price' => rand(1000, 100000),
            'total_price' => rand(200000, 20000000),
            'total_price_after_discount' => rand(200000, 20000000)
        ];
    }
}
