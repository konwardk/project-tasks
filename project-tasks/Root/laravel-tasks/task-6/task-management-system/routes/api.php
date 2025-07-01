<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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

    // project resources
    Route::resource('projects',ProjectController::class);

    //get project by status
    Route::get('/project-by-status',[ProjectController::class,'showProjectByStatus']);

});

// routes for admin and manager role
Route::middleware(['auth:sanctum', 'checkRole:admin,manager'])->group(function () {

    //get developers
    Route::get('/developers',[UserController::class,'getDevelopers']);

    // store tasks
    Route::post('/tasks', [TaskController::class, 'store']);


});

//routes for manager
Route::middleware('auth:sanctum','checkRole:manager')->prefix('manager')->name('manager.')->group(function () {

    
});


//routes for developer
Route::middleware('auth:sanctum','checkRole:developer')->prefix('developer')->name('developer.')->group(function () {

});

