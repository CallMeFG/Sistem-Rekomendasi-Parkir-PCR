<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses sebelum login)
|--------------------------------------------------------------------------
*/

// Tampilan awal website langsung ke Login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk proses login & registrasi
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


/*
|--------------------------------------------------------------------------
| Protected Routes (Hanya bisa diakses setelah login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Setelah login berhasil, arahkan ke sini
    Route::get('/analisa', function () {
        return view('welcome');
    })->name('home');

    // Fitur utama parkir
    Route::post('/check', [ParkirController::class, 'store'])->name('parkir.check');
    Route::post('/rating/{id}', [ParkirController::class, 'submitRating'])->name('parkir.rating');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/parkir/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});