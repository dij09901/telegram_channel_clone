<?php

namespace App\Http\Controllers\Account\Channel;

use App\Http\Controllers\Controller;
use App\Models\TelegramBot\TelegramProject;
use App\Models\TelegramBot\TelegramChannel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChannelController extends Controller
{
    public function __construct()
    {

    }

    public function store(Request $request, TelegramProject $telegramProject)
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);
        if (!$project) {
            return back()->with('error', 'You do not have permission to add a channel to this project.');
        }
        $project->load('channels');

        $project->channels()->create([
            'name' => $request->input('name'),
            'channel' => $request->input('channel'),
        ]);

        return back()->with('success', 'Channel added successfully.');
    }


    public function update(Request $request, TelegramProject $telegramProject, TelegramChannel $telegramChannel)
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);
        if (!$project) {
            return back()->with('error', 'You do not have permission to add a channel to this project.');
        }
        $project->load('channels');

        $channel = $project->channels()->find($telegramChannel->id);
        if (!$channel) {
            return back()->with('error', 'Channel not found in this project.');
        }

        $channel->update($request->only(['name', 'channel']));
        return back()->with('success', 'Channel updated successfully.');
    }

    public function destroy(TelegramProject $telegramProject, TelegramChannel $telegramChannel)
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);
        if (!$project) {
            return back()->with('error', 'You do not have permission to add a channel to this project.');
        }
        $project->load('channels');

        $channel = $project->channels()->find($telegramChannel->id);
        if (!$channel) {
            return back()->with('error', 'Channel not found in this project.');
        }

        $channel->delete();

        return back()->with('success', 'Channel added successfully.');
    }

}
