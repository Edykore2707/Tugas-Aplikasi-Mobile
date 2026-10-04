<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post; // Import Model Post

class PostPolicy
{
    /**
     * Menentukan apakah user dapat memperbarui postingan (Poin 2b Modul)
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}