<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->role == 1)
                    return redirect(RouteServiceProvider::ADMIN);
                if(Auth::user()->role == 2)
                    return redirect(RouteServiceProvider::TEACHER);
                if(Auth::user()->role == 3) {
                    if(Auth::user()->Students->status == 0)
                        return redirect(RouteServiceProvider::STUDENT);
                    else
                        return redirect('/take-exams');
                }              
            }
        }

        return $next($request);
    }
}
