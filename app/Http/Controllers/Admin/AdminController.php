<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    /**
     * @return Response
     */
    public function dashboard(): Response
    {
        return Inertia::render('Admin/Dashboard');
    }
}
