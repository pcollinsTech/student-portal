<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StudentUser
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
        switch (Auth::user()->type) {

            case 'admin':
                return redirect()->to(config('nova.path'));
                break;

            case 'tutor':
                return redirect()->to('/dashboard');
                break;

            case 'pharamacy':
                return redirect()->to('/dashboard');
                break;

            case'student':
            default:
                return $next($request);
                break;
        }
    }
}
