<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsertypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $usertype): Response
    {

        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Check if the usertype matches
        if (Auth::user()->usertype !== $usertype) {
            // Redirect to an unauthorized page instead of login
            return redirect('/unauthorized')->with('error', 'Unauthorized access.');
        }

        // Allow access if the usertype matches
        return $next($request);
    }
}
