<?php

namespace app\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
//use Auth;

class AdminMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
//        if (!Auth::guard('admin')->check()) {
//            return redirect()->route('admin.login');
//        }

        return $next($request);
    }
}
