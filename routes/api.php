<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth User
Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'logout')->name('logout');
});

// Get User Data
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

