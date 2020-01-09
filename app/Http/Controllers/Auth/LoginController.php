<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\BasicToken;
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

                $token = (string) $response->getBody();

                $this->saveTokens($token);

                return redirect()->route('dashboard.index');
          }

    }







    public function saveTokens(string $token) {

            $json = json_decode($token);

            Session::put('PMUAccessToken', $json->token->AccessToken);
            Session::put('PMURefreshToken', $json->token->RefreshToken);

    }


    public function deleteTokens() {

            Session::put('PMUAccessToken', '');
            Session::put('PMURefreshToken', '');

    }


    public function getCookies() {

            $token = Session::get('PMUAccessToken');
            $refresh = Session::get('PMURefreshToken');

            return array($token, $refresh);

    }

}
