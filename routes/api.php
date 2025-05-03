<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventSportifController;



Route::prefix('v1')->group(function () {
    // EventSportif API Resource Routes
    Route::apiResource('eventSportifs', EventSportifController::class);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


    });

//version 2 of the API
Route::prefix('v2')->group(function () {
    // EventSportif API Resource Routes
    Route::apiResource('eventSportifs', EventSportifController::class);
});
