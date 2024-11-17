<?php

namespace App\Http\Middleware;

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
      if (!$request->user()) {
        // Redirect to login if not authenticated
        return redirect()->route('login')->with('error', 'Please login to access this page.');
    }

    // Check if the usertype matches
    if ($request->user()->usertype !== $usertype) {
        // Redirect to login with an unauthorized message
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

        return $next($request);
    }
}
