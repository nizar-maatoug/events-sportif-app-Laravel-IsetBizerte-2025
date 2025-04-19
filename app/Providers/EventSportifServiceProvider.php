<?php

namespace App\Providers;

use App\Services\EventSportifService;
use App\Services\Interfaces\EventSportifServiceInterface;
use Illuminate\Support\ServiceProvider;

class EventSportifServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EventSportifServiceInterface::class, EventSportifService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
