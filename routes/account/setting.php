<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Account\Setting\SettingController;

Route::get('edit', [SettingController::class, 'edit'])->name('edit');
Route::get('update', [SettingController::class, 'update'])->name('update');
Route::get('destroy', [SettingController::class, 'destroy'])->name('destroy');


//account.setting.edit
