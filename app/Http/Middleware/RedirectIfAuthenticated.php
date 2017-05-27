<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Lang;

class RedirectIfAuthenticated
{
    
    protected $redirectTo = 'home';
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            
            $this->redirectTo = '/' . Lang::getLocale() . '/'. $this->redirectTo;
            
            return redirect( $this->redirectTo );
        }

        return $next($request);
    }
}
