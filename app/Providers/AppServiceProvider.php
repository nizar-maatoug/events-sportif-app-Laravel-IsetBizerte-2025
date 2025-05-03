<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Gate::define('manage-events', function (User $user) {
            return $user->isAdmin() || $user->isOrganizer();
        });

        Gate::define('manage-all-events', function (User $user) {
            return $user->isAdmin();
        });
    }
}
