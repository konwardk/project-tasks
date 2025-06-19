<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//get all users
// Route::get('/all-users',[UserController::class,'getallUser']);

Route::post('/login',[LoginController::class,'login'])->name('login');

// logout for all users
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);

//routes for admin
Route::middleware('auth:sanctum','checkRole:admin')->prefix('admin')->name('admin.')->group(function () {

    //get all users
    Route::get('/users',[UserController::class,'getallUser']);

    //get user by role
    Route::get('/users-by-role', [UserController::class, 'getUsersByRole']);

    //get manegers
    Route::get('/managers',[UserController::class,'getManagers']);

    //get developers
    Route::get('/developers',[UserController::class,'getDevelopers']);

    // project resources
    Route::resource('projects',ProjectController::class);

});

//routes for manager
Route::middleware('auth:sanctum','checkRole:manager')->prefix('manager')->name('manager.')->group(function () {

    //get all developers
    Route::get('/developers',[UserController::class,'getDevelopers']);
    
});


//routes for developer
Route::middleware('auth:sanctum','checkRole:developer')->prefix('developer')->name('developer.')->group(function () {

});

