<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;

class DeleteTelegramWebhook extends Command
{
    protected $signature = 'telegram:delete-webhook';
    protected $description = 'Delete the active Telegram webhook.';

    public function __construct()
    {
        parent::__construct();
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function handle()
    {
        $this->telegram->deleteWebhook();
        $this->info('Webhook deleted successfully.');
    }
}
