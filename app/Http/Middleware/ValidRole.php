<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::user() && auth()->user()->user_type == $role) {
            return $next($request);
        }

        switch (auth()->user()->user_type) {
            case 1:
                return redirect()->route('index');
            case 2:
                return redirect()->route('instructor.dashboard');
            case 3:
                return redirect()->route('student.dashboard');
            default:
                return redirect()->route('users.login');
        }
    }
}
