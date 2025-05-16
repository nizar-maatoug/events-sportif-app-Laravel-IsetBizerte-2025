<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();


        Gate::define('manage-events', function (User $user) {
            return $user->isAdmin() || $user->isOrganizer();
        });

        Gate::define('manage-all-events', function (User $user) {
            return $user->isAdmin();
        });
    }
}
