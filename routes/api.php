<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventSportifController;
use App\Http\Middleware\CheckRole;

Route::prefix('v1')->group(function () {
    // EventSportif API Resource Routes
    //Route::apiResource('eventSportifs', EventSportifController::class);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Public routes
    Route::get('/events', [EventSportifController::class, 'index'])
    ->name('events.index');
    // Route to specific event
    Route::get('/events/{eventSportif}', [EventSportifController::class, 'show'])
    ->name('events.show');

    // Protected routes
    // Authenticated user routes
    // These routes require authentication and are protected by the 'auth:sanctum' middleware
    // and the CheckRole middleware to check user roles.
    // The CheckRole middleware checks if the authenticated user has the specified role
    // before allowing access to the route.
    // The routes are grouped together for better organization and readability.
    // The 'auth:sanctum' middleware is used to protect the routes that require authentication.
    // The CheckRole middleware is used to check the user's role for specific routes.
    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/logout', [AuthController::class, 'logout']);

        // add event
        Route::post('/events', [EventSportifController::class, 'store'])
        ->middleware(CheckRole::class,':admin,organizer')->name('events.store');

        Route::put('/events/{eventSportif}', [EventSportifController::class, 'update'])
        ->middleware('can:update,eventSportif')->name('events.update');

        Route::delete('/events/{eventSportif}', [EventSportifController::class, 'destroy'])
        ->middleware('can:delete,eventSportif')->name('events.destroy');

        // Organizer-only routes
        Route::middleware(CheckRole::class,':organizer')->group(function () {
            Route::get('/organizer/events', [EventSportifController::class, 'organizerEvents'])
            ->name('organizer.events.index');
        });

        // Admin-only routes
        Route::middleware(CheckRole::class,':admin')->group(function () {
            Route::get('/admin/stats', [EventSportifController::class, 'adminStats'])
            ->name('admin.events.stats');
        });




    });


    });

//version 2 of the API
Route::prefix('v2')->group(function () {
    // EventSportif API Resource Routes
    Route::apiResource('eventSportifs', EventSportifController::class);
});
