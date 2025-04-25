<?php

use App\Http\Controllers\EventSportifController;
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
