<?php

namespace App\Http\Controllers\Account\Project;

use App\Http\Controllers\Controller;
use App\Models\TelegramBot\TelegramProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->user()->telegramProjects()->create($request->all());

        return back()->with('success', 'Project created successfully.');
    }

    public function show(TelegramProject $telegramProject)
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);

        if (!$project) {
            return back()->with('error', 'You do not have permission to view this project.');
        }
        $project->load('channels');
        $project->load('bots');
        $bots = $project->bots()->with('destination')->get();

        return Inertia::render('Account/Project/Show', [
            'channels' => $project->channels,
            'projectID' => $project->id,
            'bots' => $bots
        ]);
    }

    /**
     * @param Request $request
     * @param TelegramProject $telegramProject
     * @return RedirectResponse
     */
    public function update(Request $request, TelegramProject $telegramProject): RedirectResponse
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);

        if (!$project) {
            return back()->with('error', 'You do not have permission to delete this project.');
        }

        $project->update($request->only(['name', 'description']));

        return back()->with('success', 'Project deleted successfully.');
    }

    /**
     * @param TelegramProject $telegramProject
     * @return RedirectResponse
     */
    public function destroy(TelegramProject $telegramProject): RedirectResponse
    {
        $project = auth()->user()->telegramProjects()->find($telegramProject->id);

        if (!$project) {
            return back()->with('error', 'You do not have permission to delete this project.');
        }

        $project->delete();

        return back()->with('success', 'Project deleted successfully.');
    }

}
