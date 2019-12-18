<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;

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


    public function login() {

      return view('auth.login');
    }


    public function authenticate(Request $request)
    {

        $client = new Client();
        $res = $client->request('POST', 'http://localhost.pmu/api/v1/token/login', [
            'form_params' => [
                'username' => $request->email,
                'password' => $request->password,
            ]
        ]);
        echo $res->getStatusCode();
        // 200
        echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        echo $res->getBody();
        // {"type":"User"...'


    }

}
