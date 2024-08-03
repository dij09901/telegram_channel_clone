<?php

namespace App\Models\TelegramBot;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TelegramBot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'bot_token', 'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(TelegramProject::class, 'project_id');
    }

    public function destination()
    {
        return $this->hasMany(TelegramBotDestination::class, 'bot_id');
    }
}
