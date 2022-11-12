<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Coordinator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        // coordinator
        if(Auth::user()->role == 'coordinator'){
            return $next($request);
        }
        // teacher
        if(Auth::user()->role == 'teacher'){
            return redirect()->route('teacher');
        }
        // student
        if(Auth::user()->role == 'student'){
            return redirect()->route('student');
        }
    }
}
