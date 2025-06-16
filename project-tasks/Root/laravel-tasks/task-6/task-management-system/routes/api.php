<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//get all users
// Route::get('/all-users',[UserController::class,'getallUser']);

Route::post('/login',[LoginController::class,'login']);


//routes for admin
Route::middleware('auth:sanctum','checkRole:admin')->prefix('admin')->name('admin.')->group(function () {

    //get all users
    Route::get('/all-users',[UserController::class,'getallUser']);

});


//routes for manager
Route::middleware('auth:sanctum','checkRole:manager')->prefix('manager')->name('manager.')->group(function () {
    
});


//routes for developer
Route::middleware('auth:sanctum','checkRole:developer')->prefix('developer')->name('developer.')->group(function () {
    
});

