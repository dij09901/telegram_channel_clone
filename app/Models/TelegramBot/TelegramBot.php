<?php

namespace App\Models\TelegramBot;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TelegramBot extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'bot_token'
    ];

    public function project()
    {
        return $this->belongsTo(TelegramProject::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'telegram_bot_user');
    }
}
