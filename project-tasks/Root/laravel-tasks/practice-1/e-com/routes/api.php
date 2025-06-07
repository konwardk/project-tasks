<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//user register
Route::post('/register',[RegisterController::class,'register']);
//user login
Route::post('/login',[AuthController::class,'userLogin']);
