<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BusController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post('/register', [AuthController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::post('/users', [UserController::class, 'create']);
    Route::post('/bus', [BusController::class, 'create']);
    Route::post('/trip', [TripController::class, 'create']);
    Route::post('/ticket', [TicketController::class, 'create']);
});
