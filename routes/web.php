<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use Illuminate\Support\Facades\Route;

// 1. HALAMAN UTAMA (Arahkan ke Login Siswa)
Route::get('/', function () {
    return redirect()->route('siswa.login');
});

// 2. AUTH SISWA (Bisa diakses tanpa login)
Route::middleware('guest:siswa')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterSiswa'])->name('siswa.register');
    Route::post('/register', [AuthController::class, 'registerSiswa']);
    Route::get('/login', [AuthController::class, 'showLoginSiswa'])->name('siswa.login');
    Route::post('/login', [AuthController::class, 'loginSiswa'])->name('siswa.login.post');
});

// 3. AUTH ADMIN (Bisa diakses tanpa login)
Route::get('/admin/login', [AuthController::class, 'showLoginAdmin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login.submit');

// 4. AREA PROTECTED (Harus Login)
Route::middleware('auth:siswa')->group(function () {
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('siswa.dashboard');
    Route::post('/aspirasi/store', [AspirasiController::class, 'store'])->name('aspirasi.store');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/admin/dashboard', [AspirasiController::class, 'adminIndex'])->name('admin.dashboard');
    Route::post('/aspirasi/update/{id}', [AspirasiController::class, 'updateStatus'])->name('aspirasi.update');
});


// Route Siswa
Route::middleware('auth:siswa')->group(function () {
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('siswa.dashboard');
    Route::post('/aspirasi/store', [AspirasiController::class, 'store'])->name('aspirasi.store');
});

// Route Admin
Route::middleware('auth:web')->group(function () {
    Route::get('/admin/dashboard', [AspirasiController::class, 'adminIndex'])->name('admin.dashboard');
    Route::post('/admin/aspirasi/update/{id}', [AspirasiController::class, 'updateStatus'])->name('aspirasi.update');
});

Route::middleware('auth:siswa')->group(function () {
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('siswa.dashboard');
    Route::post('/aspirasi/store', [AspirasiController::class, 'store'])->name('aspirasi.store');
    
    // --- ---
    Route::get('/aspirasi/edit/{id}', [AspirasiController::class, 'edit'])->name('aspirasi.edit'); // INI YANG KURANG
    Route::put('/aspirasi/update-data/{id}', [AspirasiController::class, 'updateData'])->name('aspirasi.updateData');
    Route::delete('/aspirasi/hapus/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
   
});


// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');