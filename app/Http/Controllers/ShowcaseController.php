<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showcase;

class ShowcaseController extends Controller
{

    public function validation(Request $request, $company = null) {

        $request->validate(
          [
            'name'  => 'required',
          ]
        );

    }


    public function index() {


    }


    public function create() {


    }


    public function show(Showcase $showcase) {

          dd($showcase->pickups);

    }


    public function edit(Showcase $showcase) {


    }



}
