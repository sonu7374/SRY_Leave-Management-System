<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Register gates here
        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });

        // You can add more gates here, like:
        // Gate::define('isManager', fn ($user) => $user->role === 'manager');
    }
}
