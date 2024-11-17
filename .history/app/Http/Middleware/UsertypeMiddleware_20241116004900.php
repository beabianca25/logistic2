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
            return redirect('login')->with('error', 'Please login first.');
        }

        // Check if the usertype matches
        if ($request->user()->usertype !== $usertype) {
            return redirect('/unauthorized')->with('error', 'Access denied.');
        }
        return $next($request);
    }
}
