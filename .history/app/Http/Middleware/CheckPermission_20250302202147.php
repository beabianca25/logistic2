<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $module): Response
    {
        if (!Auth::check() || !Auth::user()->hasPermission($module)) {
            return redirect()->route('dashboard')->with('error', 'You do not have access.');
        }

        return $next($request);
    }
}
