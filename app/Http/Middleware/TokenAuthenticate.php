<?php

namespace App\Http\Middleware;


use App\Libraries\Cognito;
use Closure;
use Cookie;

class TokenAuthenticate
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


        $token = Cookie::get('PMUAccessToken');


        if (empty($token)) {

          return redirect()->route('login');

        }


        $client = new Cognito($token);

        if ($client->msgErr) {

          return redirect()->route('login')->with('msgerr', $client->msgErr);

        }


        view()->composer('admin.layouts.topbar', function ($view)  use ($client) {

                $operator = $client->user();

                $view->with(compact('operator'));
          });

          $client->refreshToken();


         return $next($request);
    }




}
