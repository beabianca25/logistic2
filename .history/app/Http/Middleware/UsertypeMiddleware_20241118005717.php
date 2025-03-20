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
       // Check if the user is logged in and has the correct type
       if (Auth::check() && Auth::user()->usertype === $usertype) {
        return $next($request);
    }

        return $next($request);
    }
}
