<?php

namespace App\Http\Controllers;


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


    public function create() {

          $user = null;
          return view('admin.users.form')->with(['user' => $user]);

    }


    public function store(Request $request) {

          $this->validation($request);

          $fields = $request->all();

          User::create($fields);

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

          $user->update($fields);

          $this->updateUserCognito($user);

          return redirect()->route('users.index')->with([
                'notification' => 'User saved with success!',
                'type-notification' => 'success'
              ]);

    }


    public function destroy() {


          return redirect()->route('users.index')->with('notification', 'User removed with success!')->with('type-notification', 'success');

    }



    protected function updateUserCognito(User $user) {

          $client = new Cognito();

          $attributes = config('cognito.user_attributes');

          $saveAttributes = array();

          foreach($attributes as $attr) {

              $field = str_replace('custom:', '', $attr);
              if ( isset($user->$field) ) {
                $saveAttributes[$field] = $user->$field;
              }
          }


          $client->setAttributes($user->sub, $saveAttributes);

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
                $user->password = bcrypt(str_random(12)); // create random password only for DB, if user login, it ill set the true one
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
