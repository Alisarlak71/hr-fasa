<?php

namespace Database\Factories;

use App\Enums\PublishStatuses;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(),
            'time' => rand(1, 12),
            'price' => rand(200000, 2000000),
            'status' => PublishStatuses::randomValue()
        ];
    }
}
