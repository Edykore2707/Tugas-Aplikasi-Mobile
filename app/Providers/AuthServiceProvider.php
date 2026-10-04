<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; // Gate facade diaktifkan
use App\Models\User;
use App\Models\Post; // Import Model
use App\Policies\PostPolicy; // Import Policy

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Poin 2c Modul: Mendaftar Policy untuk Model Post
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Poin 1a Modul: Menentukan Gate 'edit-post'
        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
    }
}