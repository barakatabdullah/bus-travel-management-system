<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BusController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post('/register', [AuthController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);


// Route::get('/email/verify/{id}/{hash}',  function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return response()->json(201);
// })->middleware(['auth:api', 'signed'])->name('verification.verify');



Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::post('/users', [UserController::class, 'create']);
    Route::get('/bus', [BusController::class, 'getBuses']);
    Route::post('/bus', [BusController::class, 'create']);
    Route::get('/trip', [TripController::class, 'getTrips']);
    Route::post('/trip', [TripController::class, 'create']);
    Route::get('/ticket', [TicketController::class, 'getTickets']);
    Route::post('/ticket', [TicketController::class, 'create']);
});
