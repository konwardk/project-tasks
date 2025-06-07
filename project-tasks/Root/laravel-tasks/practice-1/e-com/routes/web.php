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
Route::get('/admin-dashboard', function(){
    return view('admin.adminDashboard');
})->middleware(CheckRole::class);

// group middleware
Route::middleware([CheckRole::class])->group(function(){
    Route::get('/admin-dashboard', function(){
            return view('admin.adminDashboard');

    });
});