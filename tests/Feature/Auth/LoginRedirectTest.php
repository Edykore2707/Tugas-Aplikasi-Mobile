<?php

use App\Models\User;

it('redirects admin users to the dashboard after login', function () {
    $user = User::factory()->create([
        'email' => 'admin@test.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
    ]);

    $this->post('/login', [
        'email' => 'admin@test.com',
        'password' => 'password123',
    ])->assertRedirect('/dashboard');

    expect(auth()->user()->id)->toBe($user->id);
});

it('redirects kasir users to the dashboard after login', function () {
    $user = User::factory()->create([
        'email' => 'kasir@test.com',
        'password' => bcrypt('password123'),
        'role' => 'kasir',
    ]);

    $this->post('/login', [
        'email' => 'kasir@test.com',
        'password' => 'password123',
    ])->assertRedirect('/dashboard');

    expect(auth()->user()->id)->toBe($user->id);
});
