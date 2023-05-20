<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\be\AuthController;
use App\Http\Controllers\be\CategoryController;


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

// Route CRUD category
Route::middleware(["auth:api",'role:admin'])->group(function(){
    Route::get('category',[CategoryController::class,'index']);
    Route::get('category/{id}',[CategoryController::class,'single']);
    Route::post('category',[CategoryController::class,'store']);
    Route::put('category',[CategoryController::class, 'update']);
    Route::delete('category',[CategoryController::class,'delete']);
});

// Route authenticate
Route::group([
        'middleware'=>"auth:api",
        'prefix'=>"auth",
    ],function(){

    Route::post('/logout', [AuthController::class, 'logout']);
});