<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Auth;
use function foo\func;
use Illuminate\Http\Request;

class CompanyController extends Controller
{


    public function __construct()
    {

        $this->authorizeResource(Company::class);

    }


    public function validation(Request $request, $company = null)
    {

        $request->validate(
            [
                'media_id' => (empty($company) ? 'required' : '') . '',
                'name' => 'required',
                'vat' => 'required',
            ]
        );

    }


    public function index()
    {



        if (Auth::user()->is_owner) {
            //return redirect(route('companies.edit', Auth::user()->company));
            $companies = Auth::user()->brand;
        } else {
            $companies = Company::get();
        }

        return view('admin.companies.index')
            ->with(compact('companies'));

    }


    public function create()
    {

        $company = new Company();
        $users = User::where('role', 'OWNER')->get()->filter(function ($user) {
            return $user->brand->count() <= 0;
        });

        return view('admin.companies.create')->with([
                'company' => $company,
                'users' => $users,
            ]
        );

    }


    public function store(Request $request)
    {

        $this->validation($request);

        $fields = $request->all();

        $fields['status'] = $request->status ? true : false;

        $company = Company::create($fields);

        if ($fields['owner_id']) {
            User::find($fields['owner_id'])->brand()->sync($company->id);
        }

        return redirect()->route('companies.index')->with([
            'notification' => trans('messages.notification.company_saved'),
            'type-notification' => 'success'
        ]);

    }

    public function show(Company $company)
    {

        $users = User::all();

        return view('admin.companies.view')->with([
                'company' => $company,
                'users' => $users,
            ]
        );

    }


    public function edit(Company $company)
    {

        $users = User::where('role', 'OWNER')->get()->filter(function ($user) use ($company) {
            $brands = $user->brand;
            return $brands->count() <= 0 || $brands->filter(function ($brand) use ($company) {
                    return $brand->id == $company->id;
                });
        });

        return view('admin.companies.edit')->with([
                'company' => $company,
                'users' => $users
            ]
        );

    }

    public function update(Request $request, Company $company)
    {

        $this->validation($request, $company);

        $fields = $request->all();

        $fields['status'] = $request->status ? true : false;

        //clean owner before set
        $ownerOld = User::find($company->owner_id);
        $company->update($fields);

        if ($fields['owner_id']) {
            if ($ownerOld && $fields['owner_id'] != $ownerOld->id) {
                //clean old relations
                $ownerOld->brand()->sync([]);
                $ownerOld->restaurant()->sync([]);
            }

            //set new one
            User::find($fields['owner_id'])->brand()->sync($company->id);
        }

        return redirect()->route('companies.index')->with([
            'notification' => trans('messages.notification.company_saved'),
            'type-notification' => 'success'
        ]);

    }


    public function destroy(Company $company)
    {

        $company->delete();

        return redirect()->route('companies.index')->with([
            'notification' => trans('messages.notification.company_removed'),
            'type-notification' => 'warning'
        ]);

    }

    public function data(Company $company = null)
    {
        if ($company) {
            return response()->json($company, 200);
        }
        return response()->json(Company::all(), 200);

    }


}
