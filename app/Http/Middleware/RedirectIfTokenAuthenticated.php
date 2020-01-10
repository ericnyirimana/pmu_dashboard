<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Cognito;

class RedirectIfTokenAuthenticated
{
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

        $token = Session::get('PMUAccessToken');

        $client = new Cognito($token);


        if ( $client->hasValidToken() ) {

              return redirect()->route('dashboard.index');
        }


          return $next($request);

    }
}
