<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (Auth::guard('admin')->check() && !empty(Auth::guard('admin')->user()->id)) {
            return $next($request);
        }
        Session::flash('danger', 'Unauthorized access.');
        return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
  
    }
}
