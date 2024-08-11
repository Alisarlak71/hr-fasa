<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\File;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'ali sarlak',
            'cellphone' => '09184346148',
            'email' => 'ali.sarlak71@gmail.com',
            'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'ramin shokri pour',
            'cellphone' => '09129333341',
            'email' => 'rshokripur@gmail.com',
            'is_admin' => true
        ]);

        Product::factory()->count(5)->create([
            'image_id' => File::factory()->create()->id
        ]);

        $orders = Order::factory()->count(5)->create(['user_id' => $user->id])->all();

        foreach ($orders as $order) {
            OrderItem::factory()->count(4)->create(['order_id' => $order->id]);
        }
    }
}
