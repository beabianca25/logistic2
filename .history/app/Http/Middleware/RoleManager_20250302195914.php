<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        $authUserRole = Auth::user()->role;

        // Allow Super Admin to access all routes
        if ($authUserRole == -1) {
            return $next($request);
        }

        // Check the required role and allow access if the role matches
        switch ($role) {

            case 'superadmin':
                if ($authUserRole == -1) {
                    return $next($request);
                }
                break;

            case 'admin':
                if ($authUserRole == 0) {
                    return $next($request);
                }
                break;

            case 'vendor':
                if ($authUserRole == 1) {
                    return $next($request);
                }
                break;

            case 'customer':
                if ($authUserRole == 2) {
                    return $next($request);
                }
                break;
        }

        // Redirect based on role if access is denied
        return $this->redirectBasedOnRole($authUserRole);
    }

    /**
     * Redirect user based on their role with an error message.
     *
     * @param int $authUserRole
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBasedOnRole(int $authUserRole)
    {
        switch ($authUserRole) {
            case -1:
                return redirect()->route('superadmin')->with('error', 'Access Denied: Super Admins only.');
            case 0:
                return redirect()->route('dashboard')->with('error', 'Access Denied: Admins only.');
            case 1:
                return redirect()->route('vendor')->with('error', 'Access Denied: Vendors only.');
            case 2:
                return redirect()->route('user')->with('error', 'Access Denied: Customers only.');
            default:
                return redirect()->route('login')->with('error', 'Access Denied.');
        }
    }
}
