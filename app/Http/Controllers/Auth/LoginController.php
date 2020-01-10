<?php

namespace App\Http\Controllers\Auth;

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

        $this->deleteTokens();

        return redirect()->route('login');


    }





    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {

          $client = new Client();

          $authToken = BasicToken::generate();


           try {
               $response = $client->request('POST', 'http://pickmealup.com.dev7.21ilab.com/api/v1/token/login', [
                 'form_params' => [
                   'username' => $request->email,
                   'password' => $request->password
                 ],
                 'headers' => [
                    'Authorization' => 'Bearer ' . $authToken
                 ]
              ]);
            } catch (\GuzzleHttp\Exception\ClientException $e) {

                  return redirect()->route('login')->withErrors(['login' => 'Incorret login or password' ]);

            }


          if ($response->getStatusCode() == 200) {

                $tokens = (string) $response->getBody();

                $this->saveTokens($tokens);

                if ($this->checkUser($request, $tokens) == false) {

                    return redirect()->route('login')->withErrors(['login' => 'Incorret login or password' ]);
                }

                return redirect()->route('dashboard.index');
          }

    }



    /**
     * Save Tokens in Session
     *
     * @return void
     */
    public function saveTokens(string $tokens) {

            $json = json_decode($tokens);

            Session::put('PMUAccessToken', $json->token->AccessToken);
            Session::put('PMURefreshToken', $json->token->RefreshToken);

    }


    /**
     * Delete Tokens in session
     *
     * @return void
     */
    public function deleteTokens() {

            Session::put('PMUAccessToken', '');
            Session::put('PMURefreshToken', '');

    }


    /**
     * Get Tokens in session
     *
     * @return Array
     */
    public function getCookies() {

            $token = Session::get('PMUAccessToken');
            $refresh = Session::get('PMURefreshToken');

            return array($token, $refresh);

    }



    /**
     * Align user from Cognito with user from Database
     * If there is no user, create one
     *
     * @param Request $request
     * @param Strint Token
     *
     * @return boolean/Json
     */
    protected function checkUser(Request $request, string $token) {

          $client = new Cognito( Session::get('PMUAccessToken') );
          $payload = $client->getPayload();

          $user = User::where('email', $request->email)->first();

          if (!$user) {

              $user = new User;
              $user->email = $request->email;
              $user->password = bcrypt($request->password);
              $user->sub = $payload->sub;
              $user->save();

          } else {

              $user->password = bcrypt($request->password);
              $user->save();
          }

          if ($user->role != 'PMU' && $user->role != '21ILAB') {
            return false;
          }

          return true;

    }


}
