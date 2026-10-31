<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use App\Events\OrderPlaced;

it('dispatches a real-time order notification when a cashier completes a sale', function () {
    Event::fake();

    $kasir = User::create([
        'name' => 'Kasir Test',
        'email' => 'kasir'.rand(1000, 9999).'@example.com',
        'password' => 'password123',
        'role' => 'kasir',
        'email_verified_at' => now(),
    ]);

    $product = Product::create([
        'name' => 'Bola Training',
        'category' => 'Olahraga',
        'description' => 'Bola latihan premium',
        'price' => 150000,
        'stock' => 10,
        'image' => null,
        'is_active' => true,
    ]);

    $response = $this->actingAs($kasir)
        ->postJson(route('kasir.store'), [
            'cart' => [[
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 2,
                'price' => $product->price,
            ]],
            'subtotal' => 300000,
            'discount' => 0,
            'tax' => 0,
            'other_fee' => 0,
            'grand_total' => 300000,
            'paid_amount' => 300000,
            'payment_method' => 'cash',
            'change_amount' => 0,
        ]);

    $response->assertOk();
    Event::assertDispatched(OrderPlaced::class);
});
