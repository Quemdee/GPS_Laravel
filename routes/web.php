<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GpsController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/gps', [GpsController::class, 'store']);

Route::get('/track', function () {
    return view('gps');
});
