<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NotUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()) {
            if (Auth::user()->role_as !== 0) {
                return $next($request);
            } else {
                return redirect('/')->with('message', 'You are not a teacher nor the admin.');
            }
        } else {
            return redirect('/login')->with('message', 'You are not logged in.');
        }
    }
}
