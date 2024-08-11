<?php

namespace Database\Factories;

use App\Enums\ProductType;
use App\Enums\PublishStatuses;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'type' => ProductType::randomValue(),
            'category_id' => Category::factory()->create()->id,
            'short_description' => fake()->text(100),
            'body' => fake()->realText(),
            'price' => rand(200000, 2000000),
            'status' => PublishStatuses::randomValue(),
            'image_id' => File::factory()->create(['form_type' => Product::class])->id
        ];
    }
}
