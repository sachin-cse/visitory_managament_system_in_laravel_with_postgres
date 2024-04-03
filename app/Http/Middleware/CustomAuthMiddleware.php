<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Toastr;
use Illuminate\Support\Facades\Session;

class CustomAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            return $next($request);
        }
        \Session::flash('message', 'Please log in to access this page.');
        return redirect()->route('admin.login');
    }


}
