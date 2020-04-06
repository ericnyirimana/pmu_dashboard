<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{




    public function login() {

        return view('auth.login');

    }


    public function index() {

        return view('admin.index');

    }

    public function blank() {

        return view('admin.blank');

    }
}
