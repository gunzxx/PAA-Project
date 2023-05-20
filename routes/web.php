<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fe\AuthController;

Route::get('/', function () {
    return view('landing');
});


Route::group(['middleware'=>['auth:web','role:admin'],'prefix'=>'admin'],function(){
    Route::get('/home', function () {
        return view('home.index');
    });

    

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

