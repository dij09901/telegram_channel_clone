<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Account\Project\ProjectController;

//Route::get('/', [ProjectController::class, 'index'])->name('index');
Route::post('store', [ProjectController::class, 'store'])->name('store');
Route::delete('destroy/{telegramProject}', [ProjectController::class, 'destroy'])->name('destroy');
Route::put('update/{telegramProject}', [ProjectController::class, 'update'])->name('update');
