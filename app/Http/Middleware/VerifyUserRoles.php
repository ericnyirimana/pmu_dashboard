<?php

namespace App\Http\Middleware;
use Closure;
use Auth;


class VerifyUserRoles
{
    /**
     * Handle Role permissions
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        $role = Auth::user()->role;

        if(!in_array($role, config('cognito.roles'))) {

          Auth::logout();
          return redirect()->route('login')->withErrors(['login' => 'You do not have permissions to view this page.' ]);

        }

        return $next($request);


    }
}
