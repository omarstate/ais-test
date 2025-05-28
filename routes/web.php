<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AisQueryController;
use App\Http\Controllers\AisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// All routes should use web middleware for session support
Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('auth');
    });

    Route::post('/token', [AuthController::class, 'auth']);

    // Dashboard route with auth check
    Route::get('/dashboard', function (Request $request) {
        // If no token in session, check for saved token in another session variable
        if (!session('token') && session('persistent_token')) {
            // If we have a persistent token, restore the data
            session(['token' => session('persistent_token')]);
            session(['fullResponse' => session('persistent_fullResponse')]);
        }
        
        // If still no token, redirect to login
        if (!session('token')) {
            return redirect()->route('login');
        }
        
        return view('dashboard');
    })->name('dashboard');

    Route::view('/login', 'auth')->name('login');
    Route::post('/logout', [AuthController::class, 'logout']);

    // AIS Query route
    Route::post('/ais/query', [AisQueryController::class, 'query'])->name('ais.query');
    Route::post('/ais/formservice', [AisQueryController::class, 'formservice'])->name('ais.formservice');
});
