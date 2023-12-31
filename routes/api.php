<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'submit']);
    Route::post('/login/verify', [LoginController::class, 'verify']);

    // Middleware
    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('drivers', [DriverController::class, 'index']);
        Route::get('driver', [DriverController::class, 'show']);
        Route::post('driver', [DriverController::class, 'update']);

        Route::post('trip', [TripController::class, 'store']);
        Route::get('trip/{trip}', [TripController::class, 'show']);
        Route::put('trip/{trip}/accept', [TripController::class, 'accept']);
        Route::put('trip/{trip}/start', [TripController::class, 'start']);
        Route::put('trip/{trip}/end', [TripController::class, 'end']);
        Route::put('trip/{trip}/location', [TripController::class, 'location']);

        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
});
