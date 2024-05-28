<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post('/register', 'AuthController@create');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'AuthController@user');
});