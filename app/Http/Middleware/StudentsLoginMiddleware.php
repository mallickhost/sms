<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentsLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (Auth::guard('student')->check() && !empty(Auth::guard('student')->user()->id)) {
            return $next($request);
        }
        Session::flash('danger', 'Unauthorized access.');
        return redirect()->route('students.login')->with('error', 'Unauthorized access.');
  
    }
}
