<?php

use App\Http\Controllers\API\EventSportifController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('eventSportifs', EventSportifController::class);
