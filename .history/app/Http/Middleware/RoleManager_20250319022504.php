<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        $authUserRole = Auth::user()->role;

        // Super Admin has full access
        if ($authUserRole === 'superadmin') {
            return $next($request);
        }

        // Convert roles array into lowercase to avoid case mismatches
        $roles = array_map('strtolower', $roles);
        
        // If multiple roles are passed, check if the user has one of them
        if (in_array(strtolower($authUserRole), $roles)) {
            return $next($request);
        }

        // Redirect if access is denied
        return $this->redirectBasedOnRole($authUserRole);
    }

    protected function redirectBasedOnRole(string $authUserRole)
    {
        $routes = [
            'superadmin' => 'dashboard',  // Ensure superadmin goes to dashboard
            'admin'      => 'dashboard',
            'vendor'     => 'vendor',      // FIXED: Vendors should go to 'vendor', not 'userdashboard'
            'customer'   => 'userdashboard',
        ];

        return isset($routes[$authUserRole])
            ? redirect()->route($routes[$authUserRole])->with('error', 'Access Denied.')
            : redirect()->route('login')->with('error', 'Access Denied.');
    }
}
