<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Teacher
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
        // teacher
        if(Auth::user()->role == 'teacher'){
            return $next($request);
        }
        // student
        if(Auth::user()->role == 'student'){
            return redirect()->route('student');
        }
        // coordinator
        if(Auth::user()->role == 'coordinator'){
            return redirect()->route('coordinator');
        }
    }
}
