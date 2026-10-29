<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@toko-bola.test'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $product1 = Product::firstOrCreate(
            ['name' => 'Jersey Home 2026'],
            [
                'category' => 'Olahraga',
                'description' => 'Jersey tim kandang terbaru.',
                'price' => 350000,
                'stock' => 20,
                'image' => null,
                'is_active' => true,
            ]
        );

        $product2 = Product::firstOrCreate(
            ['name' => 'Jersey Away 2026'],
            [
                'category' => 'Olahraga',
                'description' => 'Jersey tim tandang terbaru.',
                'price' => 330000,
                'stock' => 15,
                'image' => null,
                'is_active' => true,
            ]
        );

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => 680000,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product1->id,
            'product_name' => $product1->name,
            'quantity' => 1,
            'price' => $product1->price,
            'subtotal' => $product1->price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product2->id,
            'product_name' => $product2->name,
            'quantity' => 1,
            'price' => $product2->price,
            'subtotal' => $product2->price,
        ]);

        $order->update([
            'total_amount' => $order->items()->sum('subtotal'),
        ]);
    }
}
