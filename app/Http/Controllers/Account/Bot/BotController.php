<?php

namespace App\Http\Controllers\Account\Bot;

use App\Http\Controllers\Controller;
use App\Models\TelegramBot\TelegramBotDestination;
use App\Models\TelegramBot\TelegramChannel;
use Illuminate\Http\Request;
use App\Models\TelegramBot\TelegramBot;
use App\Models\TelegramBot\TelegramProject;

class BotController extends Controller
{
    public function store(Request $request, TelegramProject $telegramProject)
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);
        if (!$project) {
            return back()->with('error', 'You do not have permission to add a channel to this project.');
        }
        $project->load('bots');

        $bot = $project->bots()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'bot_token' => $request->input('bot_token')
        ]);

        if ($request->has('destination')) {
            $destinations = $request->input('destination');
            foreach ($destinations as $destination) {
                    $bot->destination()->create([
                    'name' => $destination,
                    'destination' => $destination,
                ]);
            }
        }

        return back()->with('success', 'Channel added successfully.');
    }

    public function update(Request $request, TelegramProject $telegramProject, TelegramBot $telegramBot)
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

        $bot->update($request->only(['name', 'description', 'bot_token']));

        return back()->with('success', 'Channel added successfully.');
    }

    public function destroy(TelegramProject $telegramProject, TelegramBot $telegramBot)
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

        $bot->delete();

        return back()->with('success', 'Channel added successfully.');
    }
}
