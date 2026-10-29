<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

test('order items table exists for order relationships', function () {
    expect(Schema::hasTable('order_items'))->toBeTrue();
});

test('cashier transaction creates order and order items', function () {
    $user = User::factory()->create([
        'role' => 'kasir',
        'password' => 'password123',
    ]);
    $product = Product::create([
        'name' => 'Sample Product',
        'category' => 'Olahraga',
        'description' => 'Sample product description',
        'price' => 150000,
        'stock' => 25,
        'is_active' => true,
    ]);

    $this->actingAs($user)
        ->post(route('kasir.store'), [
            'cart' => [[
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 2,
                'code' => 'SP001',
            ]],
            'customer_id' => null,
            'subtotal' => 300000,
            'discount' => 0,
            'tax' => 0,
            'other_fee' => 0,
            'grand_total' => 300000,
            'paid_amount' => 300000,
            'change_amount' => 0,
            'payment_method' => 'Tunai',
        ])
        ->assertOk()
        ->assertJsonPath('success', true);

    expect(Order::count())->toBe(1);
    expect(OrderItem::count())->toBe(1);
    expect((float) Order::first()->total_amount)->toBe(300000.0);
});
