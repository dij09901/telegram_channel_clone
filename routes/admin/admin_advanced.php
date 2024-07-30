<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
