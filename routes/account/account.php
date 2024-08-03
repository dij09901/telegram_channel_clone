<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Account\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('profile')->name('profile.')->group(base_path('routes/account/profile.php'));
Route::prefix('setting')->name('setting.')->group(base_path('routes/account/setting.php'));
Route::prefix('project')->name('project.')->group(base_path('routes/account/project.php'));
Route::prefix('channel')->name('channel.')->group(base_path('routes/account/channel.php'));
Route::prefix('bot')->name('bot.')->group(base_path('routes/account/bot.php'));
