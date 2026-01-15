<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Add other admin routes
});

// Lecturer Routes
Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', [LecturerController::class, 'dashboard'])->name('dashboard');
    Route::get('/session/create', [LecturerController::class, 'createSession'])->name('session.create');
    Route::post('/session', [LecturerController::class, 'storeSession'])->name('session.store'); // Need to implement storeSession
    Route::get('/session/{id}/qr', [LecturerController::class, 'showQr'])->name('session.qr');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/scan', [StudentController::class, 'scan'])->name('scan');
    Route::post('/attendance', [StudentController::class, 'storeAttendance'])->name('attendance.store');
});
