<?php

namespace App\Http\Middleware;


use App\Libraries\Cognito;
use App\Models\User;
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

          $client = new Cognito();
          $client->connect($token);

          if ($client->error) {

            $client->deleteTokens();

            return redirect()->route('login')->withErrors( $client->error );

          }


          $cognitoUser = $client->user();

          if ( $cognitoUser['role'] == 'PMU' || $cognitoUser['role'] == '21ILAB') {

              $this->callView($cognitoUser);

              return $next($request);


          } else {

            $client->deleteTokens();

            return redirect()->route('login')->withErrors( 'User with no Permission' );

          }


    }



    private function callView($client) {

        view()->composer('admin.layouts.topbar', function ($view)  use ($client) {

              $operator = User::where('sub', $client['sub'])->first();

              $view->with(compact('operator'));
        });

    }



}
