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
    
        // Super Admin has full access, but should NOT access userdashboard routes
        if ($authUserRole === 'superadmin') {
            return $this->redirectBasedOnRole($authUserRole);
        }
    
        // Convert roles array to lowercase for case-insensitive matching
        $roles = array_map('strtolower', $roles);
    
        // Allow access only if the user has one of the specified roles
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
