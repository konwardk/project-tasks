<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthApiController;

//api login for users
Route::post('/login',[AuthApiController::class,'login']);
Route::post('/logout',[AuthApiController::class,'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    
    // Routes for attendance management (laravel task-2)

    //store attendance
    Route::post('/attendance', [AttendanceController::class, 'store']);
    
    //get attendance of a particular employee
    Route::get('/emp-attendance', [AttendanceController::class, 'getAttendance'])->name('attendance.get');
    // get all attendance
    Route::get('/attendance', [AttendanceController::class, 'getAllAttendance'])->name('attendance.getAll');
    // get todays attendance
    Route::get('today-attendance',[AttendanceController::class,'getTodayAttendance'])->name('attendance.getToday');
    //get attendance by date
    Route::get('attendance-date',[AttendanceController::class,'getAttendanceByDate'])->name('attendance.getAttendanceByDate');
    
});

// middleware for admin access (laravel task-8)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


