<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\be\AuthController;
use App\Http\Controllers\be\TouristController;
use App\Http\Controllers\be\CategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route guest
Route::prefix('auth')->group(function(){
    Route::group(['middleware' => "guest:api",], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });
    Route::group(['middleware' => "auth:api",], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

// Route CRUD category
Route::middleware(["auth:api"])->group(function(){
    // Category
    Route::get('category',[CategoryController::class,'index']);
    Route::get('category/{id}',[CategoryController::class,'single']);
    Route::post('category',[CategoryController::class,'store']);
    Route::put('category',[CategoryController::class, 'update']);
    Route::delete('category',[CategoryController::class,'delete']);
    
    // Tourist
    Route::get('tourist',[TouristController::class,'index']);
    Route::get('tourist/{id}',[TouristController::class,'single']);
    Route::post('tourist',[TouristController::class,'store']);
    Route::put('tourist',[TouristController::class, 'update']);
    Route::delete('tourist',[TouristController::class,'delete']);
});