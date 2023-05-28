<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fe\AuthController;
use App\Http\Controllers\fe\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\fe\TouristController;
use App\Http\Controllers\fe\CategoryController;

Route::get('/', function () {
    return view('landing');
});
Route::get('/tes', function () {
    dd(request()->getHost());
    return view('landing');
});


Route::group(['middleware'=>['auth:web','role:admin'],'prefix'=>'admin'],function(){
    Route::get('/home', [HomeController::class,'index']);

    Route::get('/category', [CategoryController::class,'index']);
    Route::get("/tourist", [TouristController::class, 'index']);
    Route::get("/tourist/create", [TouristController::class, 'create']);
    Route::post("/tourist/create", [TouristController::class, 'store']);
    Route::get("/tourist/edit/{id}", [TouristController::class, 'edit']);
    Route::post("/tourist/edit", [TouristController::class, 'update']);
    Route::delete("/tourist/edit", [TouristController::class, 'delete']);

    Route::get('/profile', [ProfileController::class,'index']);
    Route::post('/profile/edit', [ProfileController::class,'profile']);
    Route::post('/profile/password', [ProfileController::class,'password']);

    Route::get('/logout', [AuthController::class,'logout']);
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::group(['middleware'=>['auth:web','role:visitor'],'prefix'=>'visitor'],function(){
    Route::get('/logout', [AuthController::class,'logout']);
});

Route::group(['middleware'=>'guest:web','prefix'=>'admin'],function(){
    Route::get('login',[AuthController::class, 'getLogin'])->name('login');
    Route::post('login', [AuthController::class,'postLogin']);
});

