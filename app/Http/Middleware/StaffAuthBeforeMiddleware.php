<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Redirect;
use Illuminate\Support\Facades\Auth;

class StaffAuthBeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    { 
    	// $token = Cookie::get("TOKEN");
     //    if(!isset($token)){
     //        return Redirect::route('staff.login');
     //    }
     $session = $request->session()->all();
     // dd(Auth::guard($guard)->guest());
     if (isset($session['staff_id'])) {
        return $next($request);
     } 
        return redirect()->guest('staff/login');
    }
}
