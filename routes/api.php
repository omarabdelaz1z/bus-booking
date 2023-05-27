<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FleetController;
use App\Http\Resources\UserInfoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->delete('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return new UserInfoResource($request->user());
});

Route::controller(FleetController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/trips/{trip}', 'getAvailableTripSeats');
        Route::post('/users/{user}/bookings', 'bookTripSeat');
    });
