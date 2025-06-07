<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
// use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix('api')->group(function(){
//     Route::post('/register',[RegisterController::class,'register']);
// });

// route middleware
// Route::get('/admin-dashboard', function(){
//     return view('admin.adminDashboard');
// })->middleware(CheckRole::class);

// group middleware for admin
Route::middleware(['CheckRole:admin'])->group(function(){
    Route::get('/admin-dashboard', function(){
            return view('admin.adminDashboard');
    });
});


// group middleware for user
Route::middleware(['CheckRole:user'])->group(function(){
    Route::get('/user-home', function(){
            return view('user.adminHome');

    });
});