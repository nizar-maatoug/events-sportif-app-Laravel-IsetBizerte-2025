<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventSportifController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizerController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//CRUD
//Route::get('/eventSportifs', [EventSportifController::class, 'index'])->name('eventSportifs.index');
//Route::get('/eventSportifs/create', [EventSportifController::class, 'create'])->name('eventSportifs.create');
//Route::post('/eventSportifs', [EventSportifController::class, 'store'])->name('eventSportifs.store');
//Route::get('/eventSportifs/{eventSportif}', [EventSportifController::class, 'show'])->name('eventSportifs.show');
//Route::get('/eventSportifs/{eventSportif}/edit', [EventSportifController::class, 'edit'])->name('eventSportifs.edit');
//Route::put('/eventSportifs/{eventSportif}', [EventSportifController::class, 'update'])->name('eventSportifs.update');
//Route::delete('/eventSportifs/{eventSportif}', [EventSportifController::class, 'destroy'])->name('eventSportifs.destroy');
// Alternative way to define resource routes
Route::resource('eventSportifs', EventSportifController::class);



Route::get('', HomeController::class)->name('home');

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Protected routes for different roles
Route::middleware(['auth', CheckRole::class.':admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', CheckRole::class.':organizer'])->prefix('organizer')->group(function () {
    Route::get('/dashboard', [OrganizerController::class, 'dashboard'])->name('organizer.dashboard');
});


