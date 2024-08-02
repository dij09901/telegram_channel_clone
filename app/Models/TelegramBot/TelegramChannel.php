<?php

namespace App\Models\TelegramBot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'name'
    ];

    public function project()
    {
        return $this->belongsTo(TelegramProject::class);
    }
}
