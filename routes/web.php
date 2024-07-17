<?php

use Illuminate\Support\Facades\Route;
use DefStudio\Telegraph\Telegraph;
use \App\Http\Controllers\TelegramController;

Route::get('/', function () {
    return view('welcome');
});
//Route::post('/telegraph/{token}/webhook', [Telegraph::class, 'webhook'])->name('telegraph.webhook');
//Route::get('/telegraph/{token}/webhook', [Telegraph::class, 'webhook']);
Route::post('/telegram/receive-message', [TelegramController::class, 'receiveMessage']);
Route::get('/telegram/receive-message', [TelegramController::class, 'receiveMessage']);
