<?php

namespace App\Models\TelegramBot;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramBotDestination extends Model
{
    use HasFactory;

    protected $table = "telegram_bot_destination";

    protected $fillable = [
        'name', 'destination', 'bot_id'
    ];
}
