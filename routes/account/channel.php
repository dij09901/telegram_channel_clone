<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Account\Channel\ChannelController;

Route::post('store/{telegramProject}', [ChannelController::class, 'store'])->name('store');
//Route::get('show/{telegramProject}/{telegramChannel}', [ChannelController::class, 'show'])->name('show');
Route::delete('destroy/{telegramProject}/{telegramChannel}', [ChannelController::class, 'destroy'])->name('destroy');
Route::put('update/{telegramProject}/{telegramChannel}', [ChannelController::class, 'update'])->name('update');

