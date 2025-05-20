<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('token')) {
            $lastUrl = session('last_soal_url', '/home');

            if ($request->is('/') || $request->is('register')) {
                return redirect($lastUrl);
            }
        }

        return $next($request);
    }
}
