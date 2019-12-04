<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

use AWS;

class UserController extends Controller
{



    public function validation(Request $request, $media = null) {

        $request->validate(
          [
            'name'  => 'required',
          ]
        );

    }



    public function index() {

          $users = User::all();

          return view('admin.users.index')
          ->with( compact('users') );

    }


    public function create() {

          $user = null;
          return view('admin.users.form')->with(['user' => $user]);

    }


    public function store(Request $request) {

          $this->validation($request);

          $fields = $request->all();

          User::create($fields);

          return redirect()->route('user.index')->with([
                'notification' => 'User saved with success!',
                'type-notification' => 'success'
              ]);

    }


    public function edit(User $user) {

          return view('admin.users.form')->with(['user' => $user]);

    }


    public function destroy() {


          return redirect()->route('users.index')->with('notification', 'User removed with success!')->with('type-notification', 'success');

    }


    public function cognito() {

      return $this->authenticate('marco@pickmealup.com', 'qwerty123');
    }


    public function authenticate(string $username, string $password) : string
    {

      $client = new CognitoIdentityProviderClient([
          'version' => env('AWS_COGNITO_VERSION'),
          'region' => env('AWS_COGNITO_REGION'),
        ]);

        try {
            $result = $client->adminInitiateAuth([
                'AuthFlow' => 'ADMIN_NO_SRP_AUTH',
                'ClientId' => env('AWS_COGNITO_CLIENT_ID'),
                'UserPoolId' => env('AWS_COGNITO_USER_POOL_ID'),
                'AuthParameters' => [
                    'USERNAME' => $username,
                    'PASSWORD' => $password,
                ],
            ]);


        } catch (\Exception $e) {

          return $e->getMessage();
        }
        return $result->get('AuthenticationResult')['AccessToken'];
        return '';
    }

}
