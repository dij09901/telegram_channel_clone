<?php

namespace App\Models\TelegramBot;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channels()
    {
        return $this->hasMany(TelegramChannel::class, 'project_id');

    }

    public function bots()
    {
        return $this->hasMany(TelegramBot::class, 'project_id');
    }
}
