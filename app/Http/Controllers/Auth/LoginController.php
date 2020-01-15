<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Libraries\BasicToken;
use App\Libraries\Cognito;

use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */






    /**
     * View page index
     *
     * @return void
     */
    public function index()
    {

        return view('auth.login');

    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');


    }





    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {

          $client = new Cognito();

          #connect with Cognito
          $credentials = $request->only('email', 'password');

          $response = $client->authenticate($credentials);

          if ($client->error) {

              return redirect()->route('login')->withErrors(['login' => 'Incorret login or password.' ]);
          }


          if ($response) {

                $token = $response['token']['AccessToken'];

                #align user from Cognito
                $sync = $this->alignUserFromCognito($request, $token);

                #if Authenticate with cognito, connect with normal DB
                #The user from DB is a clone from Cognito, it copies every time it log
                if ($sync && Auth::attempt($credentials, $request->remember)) {

                    return redirect()->route('dashboard.index');
                } else {

                    return redirect()->route('login')->withErrors(['login' => 'Something wrong happened.' ]);
                }


          }

    }



    /**
     * Align user from Cognito with user from Database
     * If there is no user, create one
     *
     * @param Request $request
     * @param Strint Token
     *
     * @return boolean
     */
    protected function alignUserFromCognito(Request $request, $token) {

          $client = new Cognito();

          $client->connect( $token );

          $cognitoUser = $client->user();

          $user = User::where('email', $request->email)->first();

          #If no user, create instance based on email
          if (!$user) {
              $user = new User;
              $user->email = $request->email;

          }

          #Update all information from Cognito, it ensures to have Cognito and DB aligned
          $user->password = bcrypt($request->password);
          $user->sub = $cognitoUser['sub'];
          $user->role = $cognitoUser['role'];
          $user->profile = json_encode($cognitoUser);

          $user->save();

          if ($user) {
              return true;
          }

          return false;


    }






}
