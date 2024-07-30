<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::prefix('profile')->name('profile.')->group(base_path('routes/account/profile.php'));
Route::prefix('setting')->name('setting.')->group(base_path('routes/account/setting.php'));
