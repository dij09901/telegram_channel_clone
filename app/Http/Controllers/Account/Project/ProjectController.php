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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $request->user()->telegramProjects()->create($request->all());

        return back()->with('success', 'Project created successfully.');
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
