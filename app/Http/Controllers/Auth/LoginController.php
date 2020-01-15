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

          #connect with Cognito
          $credentials = $request->only('email', 'password');

          $client = new Cognito();
          $response = $client->authenticate($credentials);

          if ($client->error) {

              return redirect()->route('login')->withErrors(['login' => 'Incorret login or password.' ]);
          }

          if ($client->forceResetPassword) {

              $data = [
                  'ChallengeName'     => $response->get('ChallengeName'),
                  'challengeSession'  => $response->get('Session'),
                  'sub'               => $response->get('ChallengeParameters')['USER_ID_FOR_SRP'],
                  'email'             => $request->email
                ];

              return redirect()->route('password.set')->with($data);


          }

          if ($response) {

                $token = $response['token']['AccessToken'];

                #align user from Cognito
                $sync = $this->alignUserFromCognito($request);

                #if Authenticate with cognito, connect with normal DB
                #The user from DB is a clone from Cognito, it copies every time it log
                if ($sync && Auth::attempt($credentials, $request->remember)) {

                    return redirect()->route('dashboard.index');
                } else {

                    return redirect()->route('login')->withErrors(['login' => 'Something wrong happened.']);
                }

          }

    }



    /**
     * View page index
     *
     * @return void
     */
    public function setPassword()
    {

        Session::flash('ChallengeName', Session::get('ChallengeName'));
        Session::flash('challengeSession', Session::get('challengeSession'));
        Session::flash('sub', Session::get('sub'));
        Session::flash('email', Session::get('email'));

        return view('auth.passwords.confirm');

    }


    /**
     * View page index
     *
     * @return void
     */
    public function confirmPassword(Request $request)
    {

        $data = ['ChallengeName' => Session::get('ChallengeName'), 'challengeSession' => Session::get('challengeSession'), 'sub' => Session::get('sub'), 'email' => Session::get('email')];

        if ($request->password != $request->confirm_password) {

              return redirect()->route('password.set')->withErrors(['password' => 'The password does not match.' ])->with($data);

        }

        $client = new Cognito();
        $respond = ['NEW_PASSWORD' => $request->password, 'USERNAME' => $data['sub']];

        $result = $client->challengeRespond($data['ChallengeName'], $respond, $data['challengeSession']);

        if ($client->error) {
          return redirect()->route('password.set')->withErrors(['password' => $client->error])->with($data);
        }

        $sendRequest = new Request(['email' => $data['email'], 'password' => $request->password]);

        return $this->login($sendRequest);


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
    protected function alignUserFromCognito(Request $request) {

          $client = new Cognito();

          $user = $client->getUser($request->email);

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
