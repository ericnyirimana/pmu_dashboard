<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Cookie;
use App\Libraries\Cognito;
use Carbon\Carbon;


class UserController extends Controller
{



    public function validation(Request $request, $media = null) {

        $request->validate(
          [
            'name'  => 'required',
          ]
        );

    }



    public function me() {

          $user = Auth::user();

          return view('admin.users.profile')
          ->with( compact('user') );

    }



    public function index() {

          $this->alignUsersFromCognito();

          $users = User::all();

          return view('admin.users.index')
          ->with( compact('users') );

    }


    public function show(User $user) {

          return redirect()->route('users.index');

    }


    public function create() {

          $user = null;
          return view('admin.users.form')->with(['user' => $user]);

    }


    public function store(Request $request) {

          $this->validation($request);

          $fields = $request->all();

          $arrayAttributes = $this->prepareAttributes($fields);

          $uuid = (string) Str::uuid();
          $fields['sub'] = $uuid;
          $fields['password'] = bcrypt( Str::random(12) );

          $fields['profile'] = json_encode($arrayAttributes);

          $user = User::create($fields);


          $client = new Cognito();
          $client->createUser($user->email, $arrayAttributes);

          return redirect()->route('users.index')->with([
                'notification' => 'User saved with success!',
                'type-notification' => 'success'
              ]);

    }


    public function edit(User $user) {

          return view('admin.users.form')->with(['user' => $user]);

    }


    public function update(User $user, Request $request) {

          $this->validation($request);

          $fields = $request->all();

          $arrayAttributes = $this->prepareAttributes($fields);

          $fields['profile'] = json_encode($arrayAttributes);

          $user->update($fields);


          $client = new Cognito();
          $us = $client->getUser($user->sub);

          $client->updateUser($user->sub, $arrayAttributes);

          return redirect()->route('users.index')->with([
                'notification' => 'User saved with success!',
                'type-notification' => 'success'
              ]);

    }


    public function destroy(User $user) {

          $user->delete();

          return redirect()->route('users.index')->with('notification', 'User removed with success!')->with('type-notification', 'success');

    }


    /**
    * Prepare attributes to send in Cognito format
    *
    * @return Array
    */
    protected function createUniqueSub() {


    }


    /**
    * Prepare attributes to send in Cognito format
    *
    * @return Array
    */
    protected function prepareAttributes($fields) {

      $attributes = config('cognito.user_attributes');

      $saveAttributes = array();

      foreach($attributes as $attr) {

          $field = str_replace('custom:', '', $attr);

          if ( isset($fields[$field]) ) {
            $saveAttributes[$field] = $fields[$field];
          }
      }

      return $saveAttributes;

    }



    /**
    * Sync all users from Cognito and Database
    * Create new users in DB case it is no exists
    *
    * @return Void
    */
    protected function alignUsersFromCognito() {


        $client = new Cognito();
        $cognito = $client->listUser();

        foreach ($cognito['Users'] as $cognitoUser) {

            $sub = $cognitoUser['Username'];
            $attributes = $cognitoUser['Attributes'];

            $user = User::where('sub', $sub)->first();

            if (!$user) {

                $user = new User;
                $user->password = bcrypt( Str::random(12) ); // create random password only for DB, if user login, it ill set the true one
                $user->email = $client->search('email', $attributes);
                $user->sub = $sub;
                $user->created_at = $cognitoUser['UserCreateDate'];


            }

            $user->updated_at = $cognitoUser['UserLastModifiedDate'];
            $user->role = $client->search('custom:role', $attributes) ?? 'CUSTOMER';

            $profile = array();
            foreach(config('cognito.user_attributes') as $attribute) {

                  $item = str_replace('custom:', '', $attribute);
                  $profile[$item] = $client->search($attribute, $attributes);

            }

            $user->profile = json_encode($profile);
            $user->save();
        }


    }




}
