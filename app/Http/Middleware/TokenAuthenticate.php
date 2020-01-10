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

          $token = session('PMUAccessToken');

          if (empty($token)) {

            return redirect()->route('login');

          }

          $client = new Cognito($token);

          if ($client->error) {

            $client->deleteTokens();

            return redirect()->route('login')->withErrors( $client->error );

          }


          $attributes = $client->UserAttributes;

          $role = $client->search('custom:role');

          if ( !$role == 'PMU' || !$role == '21ILAB') {

              $client->deleteTokens();

              return redirect()->route('login')->withErrors( 'User with no Permission' );

          }


          $this->callView($client);

          return $next($request);

    }



    private function callView($client) {

        view()->composer('admin.layouts.topbar', function ($view)  use ($client) {

              $operator = $client->user();

              $view->with(compact('operator'));
        });

    }



}
