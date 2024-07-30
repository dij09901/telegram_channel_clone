<?php

namespace App\Models\TelegramBot;

class TelegramBotUser extends Pivot
{
    use HasFactory;

    protected $table = 'telegram_bot_user';
}
