<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;

Route::middleware('auth:sanctum')->group(function () {
    
    // Routes for attendance management (laravel task-2)
    Route::post('/attendance', [AttendanceController::class, 'store']);
    Route::get('/attendance', [AttendanceController::class, 'getAttendance'])->name('attendance.get');
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// middleware for admin access (laravel task-8)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Add other admin routes here
});


