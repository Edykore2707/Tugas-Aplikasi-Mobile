<?php

use App\Models\User;

it('redirects guests to login when they access the application root', function () {
    $this->get('/')
        ->assertRedirect('/login');
});

it('redirects authenticated users to dashboard from the root route', function () {
    $user = User::factory()->create([
        'email' => 'admin@test.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
    ]);

    $this->actingAs($user)
        ->get('/')
        ->assertRedirect('/dashboard');
});

it('allows authenticated users to access the dashboard', function () {
    $user = User::factory()->create([
        'email' => 'kasir@test.com',
        'password' => bcrypt('password123'),
        'role' => 'kasir',
    ]);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk();
});
