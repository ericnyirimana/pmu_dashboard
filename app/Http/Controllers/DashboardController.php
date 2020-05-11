<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Pickup;

use Auth;

class DashboardController extends Controller
{

    public function login() {

        return view('auth.login');

    }

    public function index() {

        if (Auth::user()->is_owner) {
            $companies = Auth::user()->brand;
        } else {
            $companies = Company::limit(3)->get();
        }

        $pickups = Pickup::limit(4)->get();

        return view('admin.index')
            ->with(compact('companies'))
            ->with(compact('pickups'));

    }

//    public function blank() {
//
//        return view('admin.blank');
//
//    }

}
