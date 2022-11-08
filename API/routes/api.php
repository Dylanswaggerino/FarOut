<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::prefix('countries')->group(function () {
    Route::get('/', [CountryController::class, 'index']);
});

Route::prefix('trips')->group(function () {
    Route::get('/', [TripController::class, 'index']);
    Route::get('topten', [TripController::class, 'topten']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::get('is-employee', [AuthController::class, 'isEmployee']);
        Route::post('checkToken', [AuthController::class, 'checkToken']);
    });

    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
    });

    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index']);
    });

    Route::prefix('reservations')->group(function () {
        Route::get('/', [ReservationController::class, 'index']);

        Route::prefix('{id}')->group(function () {
            Route::get('/', [ReservationController::class, 'show']);
            Route::delete('delete', [ReservationController::class, 'destroy']);
        });
    });
});
