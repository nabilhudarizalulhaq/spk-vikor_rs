<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VikorController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/rumah_sakit/{id}', [HospitalController::class, 'show'])->name('hospital.show');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/rumah_sakit', [HospitalController::class, 'index'])->name('hospital.index');
Route::get('/rekomendasi', [VikorController::class, 'index'])->name('vikor.index');

require __DIR__ . '/auth.php';
