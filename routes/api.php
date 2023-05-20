<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\be\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route guest
Route::group([
        'middleware'=>"guest:api",
        'prefix'=>"visitor",
    ],function(){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
});

// Route authenticate
Route::group([
        'middleware'=>"auth:api",
        'prefix'=>"auth",
    ],function(){

    Route::post('/logout', [AuthController::class, 'logout']);
});