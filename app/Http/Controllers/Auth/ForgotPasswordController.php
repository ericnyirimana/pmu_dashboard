<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Libraries\Cognito;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function validation(Request $request)
    {

        $request->validate(
            [
                'code' => 'required',
                'password' => 'required',
                'confirm_password' => 'required',
            ]
        );

    }

    public function index()
    {


        return view('auth.passwords.forgot-password');

    }

        /**
     * Set new values or refresh the Flash session.
     * Since flash session is lost when loaded, it must be set again.
     *
     * @return void
     */
    public function refreshFlashSetPasswordSession($challengeName = null, $challengeSession = null, $sub = null, $email = null)
    {

        Session::flash('ChallengeName', ($challengeName ?? Session::get('ChallengeName') ) );
        Session::flash('challengeSession', ($challengeSession ?? Session::get('challengeSession')) );
        Session::flash('sub', ($sub ?? Session::get('sub')) );
        Session::flash('email', ($email ?? Session::get('email')) );


    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function sendResetLinkPassword(Request $request)
    {

          #connect with Cognito
          $credentials = $request->only('email');

          $email = Str::lower($credentials['email']);
          $client = new Cognito();
          $response = $client->sendResetLink($email);

          if ($client->error) {

              return redirect()->route('forgot.password')->withErrors(['login' => 'Something went wrong' ]);
          }

          if ($response) {
            return redirect()->route('forgot.password')->with([
                'message' => trans('messages.notification.email_sent_for_password_reset', ['email' => $email]),
            ]);

          }

    }

    /**
    *
    * @return void
    */
   public function resetPassword(Request $request)
   {
        return view('auth.passwords.confirm-reset')->with([
            'token' => $request->all()['token']
        ]);
   }

     /**
     *
     * @return void
     */
    public function confirmResetPassword(Request $request)
    {
        $this->validation($request);
        $fields = $request->all();
        $username = base64_decode($fields['token']);
        if ($request->password != $request->confirm_password) {

              return redirect()->route('reset.password', ['token' => $fields['token']])->withErrors(['password' => 'The password does not match.' ]);

        }

        $client = new Cognito();
        $response = $client->confirmForgotPassword($username, $fields['code'], $request->password);

          if ($client->error) {
            return redirect()->route('reset.password', ['token' => $fields['token']])->withErrors(['code' => $client->error ]);
          }

          if ($response) {
                    return redirect()->route('login');

          }


    }
}
