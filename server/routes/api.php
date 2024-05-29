<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post('/register', [AuthController::class, 'create']);
Route::get('/test', function(){
    try{
        $data='hello';
        return response()->json($data, 200);
    }catch (Exception $e) {
        return response()->json($e, 500);
}
});

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'AuthController@user');
});