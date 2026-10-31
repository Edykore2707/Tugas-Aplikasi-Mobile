<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('admin.orders', function ($user) {
    return $user && $user->role === 'admin';
});

// Channel privat untuk Event OrderPlaced (user.{id})
Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});