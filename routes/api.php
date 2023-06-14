<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\be\AuthController;
use App\Http\Controllers\be\ReviewController;
use App\Http\Controllers\be\TouristController;
use App\Http\Controllers\be\CategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Authentikasi
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Kategori
Route::get('category', [CategoryController::class, 'index']);
Route::get('category/{id}', [CategoryController::class, 'single']);
Route::post('category', [CategoryController::class, 'store']);
Route::put('category', [CategoryController::class, 'update']);
Route::delete('category', [CategoryController::class, 'delete']);

// Pariwisata
Route::get('tourist', [TouristController::class, 'index']);
Route::get('tourist/{id}', [TouristController::class, 'single']);
Route::post('tourist',[TouristController::class,'store']);
Route::post('tourist/edit',[TouristController::class, 'update']);
Route::delete('tourist',[TouristController::class,'delete']);

// Review
Route::get("review",[ReviewController::class,'index']);
Route::get("review/{id}",[ReviewController::class,'single']);
Route::post("review",[ReviewController::class,'create']);
Route::put("review",[ReviewController::class,'update']);
Route::delete("review",[ReviewController::class,'delete']);