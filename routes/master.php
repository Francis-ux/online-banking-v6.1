<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Master\HomeController;
use App\Http\Controllers\Dashboard\Master\AdminController;
use App\Http\Controllers\Dashboard\Master\ProfileController;

Route::middleware('master')->prefix('master')->group(function () {
    Route::get('/dashboard', HomeController::class)->name('master.dashboard');

    Route::get('/admin', [AdminController::class, 'index'])->name('master.admin.index');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('master.admin.edit');
    Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('master.admin.update');

    Route::get('/profile', [ProfileController::class, 'index'])->name('master.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('master.profile.update');
});
