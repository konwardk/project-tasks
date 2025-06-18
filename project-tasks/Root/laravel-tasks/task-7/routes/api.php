<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CSVController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//register
Route::post('/register',[RegisterController::class,'register']);
//login
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum','auth.custom')->group(function(){
    
    //logout
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/user',[AuthController::class,'getUser']);

    //upload file 
    Route::post('/upload',[FileController::class,'uploadFile']);

    //upload/ import CSV file
    Route::post('/upload-csv',[CSVController::class,'uploadCSV']);
    //show data 
    Route::get('/show-data',[CSVController::class,'showData']);
    //export data 
    Route::get('/export-data',[CSVController::class,'exportData']);
    Route::get('/export-data-new',[CSVController::class,'exportProducts']);
});

