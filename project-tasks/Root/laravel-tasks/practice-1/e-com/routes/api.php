<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FileController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//register
Route::post('/register',[RegisterController::class,'register']);
//login
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    
    //logout
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/user',[AuthController::class,'getUser']);

    //upload file 
    Route::post('/upload',[FileController::class,'uploadFile']);


});