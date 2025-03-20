<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleOrPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('Middleware Check', [
            'user' => auth()->user()->email ?? 'Guest',
            'roles' => auth()->user() ? auth()->user()->getRoleNames() : [],
            'permissions' => auth()->user() ? auth()->user()->getAllPermissions()->pluck('name') : [],
        ]);
        
        return $next($request);
    }
}
