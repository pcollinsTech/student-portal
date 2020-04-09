<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RegistrationOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        If registration is closed
//        Need to run checks to see if registration is open
        if(1 == 2) {
//            Log user out
            Auth::logout();

//            Redirect to landing page
            return redirect()->to('/');
        }
        return $next($request);
    }
}
