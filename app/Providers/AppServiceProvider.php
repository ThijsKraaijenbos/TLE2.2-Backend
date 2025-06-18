<?php

namespace App\Providers;

use App\Models\AdminKey;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function ($user) {
            $key = AdminKey::where('user_id', $user->id);
            return (bool)$key;
        });
    }
}
