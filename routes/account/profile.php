<?php

use App\Http\Controllers\Account\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
Route::get('update', [ProfileController::class, 'update'])->name('update');
Route::get('destroy', [ProfileController::class, 'destroy'])->name('destroy');
