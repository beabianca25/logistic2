<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $module)
    {
        if (!Auth::user()->hasPermission($module)) {
            return redirect()->route('dashboard')->with('error', 'You do not have access.');
        }

        return $next($request);
    }
}
