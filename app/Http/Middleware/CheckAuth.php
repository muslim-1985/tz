<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check())  return redirect('login');

        $userID = Auth::user()->id;

        if (auth()->check() && auth()->user()->hasRole($userID, config('app.roles')[$role])) {
            return $next($request);
        }

        return redirect('login');
    }
}
