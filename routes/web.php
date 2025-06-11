<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AisQueryController;
use App\Http\Controllers\AisController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// Public routes
Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('auth');
    });

    Route::post('/token', [AuthController::class, 'auth']);
    Route::view('/login', 'auth')->name('login');
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Protected routes that require token authentication
Route::middleware(TokenAuthentication::class)->group(function () {
    Route::view('/dashboard', 'dashboard');
    Route::post('/ais/query', [AisQueryController::class, 'query'])->name('ais.query');
    Route::post('/ais/formservice', [AisQueryController::class, 'formservice'])->name('ais.formservice');
});
