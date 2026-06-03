<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SafariController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // User profile
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    
    // Safari packages
    Route::get('/safaris', [SafariController::class, 'index']);
    Route::get('/safaris/{slug}', [SafariController::class, 'show']);
    Route::get('/safaris/featured', [SafariController::class, 'featured']);
    
    // Destinations
    Route::get('/destinations', [DestinationController::class, 'index']);
    Route::get('/destinations/{slug}', [DestinationController::class, 'show']);
    
    // Bookings
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
});
