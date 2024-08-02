<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * @return Response
     */
    public function index(): Response
    {
        $projects = $this->request->user()->telegramProjects()->get();

        return Inertia::render('Account/Project/Index', [
            'mustVerifyEmail' => $this->request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'projects' => $projects
        ]);
    }
}
