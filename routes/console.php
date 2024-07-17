<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

// Реєстрація команди вручну
//Artisan::command('telegram:forward-messages', \App\Console\Commands\ForwardTelegramMessages::class);
