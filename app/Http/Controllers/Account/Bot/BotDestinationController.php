<?php

namespace App\Http\Controllers\Account\Bot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TelegramBot\TelegramBot;
use App\Models\TelegramBot\TelegramBotDestination;
use App\Models\TelegramBot\TelegramProject;

class BotDestinationController extends Controller
{
    public function destroy(TelegramProject $telegramProject, TelegramBot $telegramBot, TelegramBotDestination $telegramBotDestination)
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);
        if (!$project) {
            return back()->with('error', 'You do not have permission to add a channel to this project.');
        }
        $project->load('bots');

        $bot = $project->bots()->find($telegramBot->id);
        if (!$bot) {
            return back()->with('error', 'Channel not found in this Bot.');
        }

        $bot->load('destination');
        $destination = $bot->destination()->find($telegramBotDestination->id);
        $destination->delete();

        return back()->with('success', 'Channel added successfully.');
    }

    public function store(Request $request, TelegramProject $telegramProject, TelegramBot $telegramBot)
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);
        if (!$project) {
            return back()->with('error', 'You do not have permission to add a channel to this project.');
        }
        $project->load('bots');
        $bot = $project->bots()->find($telegramBot->id);
        if (!$bot) {
            return back()->with('error', 'Channel not found in this Bot.');
        }
        $bot->load('destination');
        $bot->destination()->create([
            'name' => $request->input('name'),
            'destination' => $request->input('destination')
        ]);

        return back()->with('success', 'Channel Remove successfully.');
    }
}
