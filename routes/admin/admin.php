<?php

use Illuminate\Support\Facades\Route;

//Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return \Inertia\Inertia::render('Admin/AdminDashboard');
    })->name('admin.dashboard');

//    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Додайте інші адміністративні маршрути тут
//});
