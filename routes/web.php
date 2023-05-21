<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fe\AuthController;
use App\Http\Controllers\fe\HomeController;
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

