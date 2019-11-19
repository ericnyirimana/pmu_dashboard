<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{


    /**
     * The attributes that set Datatable headers and fields.
     *
     * @var array
     */
    protected $datatableFields = [
        'id'        => 'ID',
        'full_name' => 'Name',
        'email'     => 'Email',
    ];



    public function __construct() {



      view()->composer('admin.components.datatable', function ($view) {

          $fields = $this->datatableFields;

          $route = \Route::getCurrentRoute()->uri;

          $view
          ->with([
            'fields' => $fields,
            'route'  => $route
          ]);

        });

    }



    public function index() {


      $users = user::all();

      return view('admin.users.index')
      ->with( compact('users') );

    }


    public function create() {


      return view('admin.users.form');

    }


    public function edit() {


      return view('admin.users.form');

    }


    public function destroy() {


      return redirect()->route('users.index')->with('notification', 'User removed with success!')->with('type-notification', 'success');
    }
}
