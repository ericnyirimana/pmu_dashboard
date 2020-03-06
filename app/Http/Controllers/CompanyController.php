<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\User;
use App\Models\Media;
use Auth;

class CompanyController extends Controller
{


      public function __construct() {

        $this->authorizeResource(Company::class);

      }



      public function validation(Request $request, $company = null) {

          $request->validate(
            [
              'media_id'  => (empty($company)?'required':'').'',
              'name'  => 'required',
              'vat'   => 'required'
            ]
          );

      }



      public function index() {

          $companies = Company::get();

          if (Auth::user()->is_owner) {

            return redirect( route('companies.edit', Auth::user()->company));
          }

          return view('admin.companies.index')
          ->with( compact('companies') );

      }


      public function create() {

            $company = new Company();
            $users = User::all();


            return view('admin.companies.create')->with([
              'company'   => $company,
              'users'   => $users,

            ]
            );

      }


      public function store(Request $request) {

            $this->validation($request);

            $fields = $request->all();

            Company::create($fields);

            return redirect()->route('companies.index')->with([
                  'notification' => 'Company saved with success!',
                  'type-notification' => 'success'
                ]);

      }

      public function show(Company $company) {

            $users = User::all();

            return view('admin.companies.view')->with([
              'company'     => $company,
              'users'     => $users,
            ]
            );

      }


      public function edit(Company $company) {

            $users = User::all();

            return view('admin.companies.edit')->with([
              'company'   => $company,
              'users'   => $users
            ]
            );

      }

      public function update(Request $request, Company $company) {

            $this->validation($request, $company);

            $fields = $request->all();

            $fields['status'] = $request->status ? true : false;

            $company->update($fields);

            return redirect()->route('companies.index')->with([
                  'notification' => 'Company saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Company $company) {

            $company->delete();

            return redirect()->route('companies.index')->with([
                  'notification' => 'Company removed with success!',
                  'type-notification' => 'warning'
                ]);

      }


}
