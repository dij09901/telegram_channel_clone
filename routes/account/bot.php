<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Account\Bot\BotController;
use \App\Http\Controllers\Account\Bot\BotDestinationController;

Route::post('store/{telegramProject}', [BotController::class, 'store'])->name('store');
Route::delete('destroy/{telegramProject}/{telegramBot}', [BotController::class, 'destroy'])->name('destroy');
Route::put('update/{telegramProject}/{telegramBot}', [BotController::class, 'update'])->name('update');

Route::prefix('destination')->name('destination.')->group(function () {
    Route::delete('destroy/{telegramProject}/{telegramBot}/{telegramBotDestination}', [BotDestinationController::class, 'destroy'])->name('destroy');
    Route::post('store/{telegramProject}/{telegramBot}', [BotDestinationController::class, 'store'])->name('store');
});

