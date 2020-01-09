<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Cookie;
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

          $user = null;

          $token = Cookie::get('PMUAccessToken');
          $refresh = Cookie::get('PMURefreshToken');

          return view('admin.users.profile')
          ->with( compact('token') )
          ->with( compact('refresh') )
          ->with( compact('user') );

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

}
