<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoggedOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('employee')->check()) {
            return redirect('/employee/dashboard');
        }
        if (auth('admin')->check()) {
            return redirect('/admin/dashboard');
        }
        if (auth('hospital')->check()) {
            return redirect('/hospital/dashboard');
        }
        return $next($request);
    }
}
