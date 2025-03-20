<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        $authUserRole = Auth::user()->role;

        // Super Admin has full access
        if ($authUserRole == -1) {
            return $next($request);
        }

        // Define role mappings
        $roles = [
            'superadmin' => -1,
            'admin'      => 0,
            'vendor'     => 1,
            'customer'   => 2,
        ];

        // Check if the role matches
        if (isset($roles[$role]) && $authUserRole == $roles[$role]) {
            return $next($request);
        }

        // Redirect if access is denied
        return $this->redirectBasedOnRole($authUserRole);
    }

    protected function redirectBasedOnRole(int $authUserRole)
    {
        $routes = [
            -1 => 'superadmin',
            0  => 'dashboard',
            1  => 'vendor',
            2  => 'user',
        ];

        return isset($routes[$authUserRole])
            ? redirect()->route($routes[$authUserRole])->with('error', 'Access Denied.')
            : redirect()->route('login')->with('error', 'Access Denied.');
    }
}
