<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\User;
use Auth;
use Cookie;
use App\Libraries\Cognito;
use Illuminate\Validation\Rule;


class UserController extends Controller
{


    public function __construct()
    {

        $this->authorizeResource(User::class);

    }


    public function validation(Request $request, User $user = null)
    {
        $rules = [
            'name' => 'required',
            'brand_id' => 'required_if:role,RESTAURATEUR,OWNER,SALES_ASSISTANT',
            'restaurant_id' => 'required_if:role,RESTAURATEUR,SALES_ASSISTANT'
        ];

        if ($user) {
            $rules['email'] = [
                'required',
                Rule::unique('users')->ignore($user->id),
            ];
        } else {
            $rules['email'] = [
                'required',
                Rule::unique('users'),
            ];
        }

        $request->validate(
            $rules
        );

    }


    public function me()
    {

        $user = Auth::user();
        if(Auth::user()->is_owner || Auth::user()->is_restaurant) {
            $edit = false;
        }
        return view('admin.users.profile')
            ->with([
                'user' => $user,
                'edit' => true
            ]);

    }


    public function index()
    {
        $this->alignUsersFromCognito();

        if (Auth::user()->is_super) {
            $users = User::withTrashed()->get();
        } else if (Auth::user()->is_owner) {
            $users = Auth::user()->brand->first()->users;
        } else if (Auth::user()->is_restaurant) {
            $users = Auth::user()->restaurant->first()->users->where('role', '!=' ,'OWNER');
        }

        return view('admin.users.index')
            ->with(compact('users'));

    }


    public function show(User $user)
    {

        return redirect()->route('users.edit', $user);

    }


    public function create()
    {

        $user = new User();
        $company = Company::all();
        return view('admin.users.create')->with([
            'user' => $user,
            'company' => $company,
            'edit' => false
        ]);

    }


    public function store(Request $request)
    {

        $this->validation($request);


        $fields = $request->all();

        $arrayAttributes = $this->prepareAttributes($fields);

        $uuid = (string)Str::uuid();
        $fields['sub'] = $uuid;
        $fields['password'] = bcrypt(Str::random(12));

        $fields['profile'] = json_encode($arrayAttributes);

        $fields['email'] = Str::lower($fields['email']);

        $user = User::create($fields);

        if (isset($fields['brand_id'])) {
            $user->brand()->sync($fields['brand_id']);
            if ($user->is_owner) {
                $company = Company::find($fields['brand_id']);
                $company->owner_id = $user->id;
                $company->save();

                // Relation with all restaurant in company
                $restaurantIDs = $company->restaurants()->pluck('id');
                $user->restaurant()->sync($restaurantIDs);
            }
            if (isset($fields['restaurant_id']) && !$user->is_owner) {
                $user->restaurant()->sync($fields['restaurant_id']);
            }
        }

        $client = new Cognito();
        $client->createUser($user->email, $arrayAttributes);

        if ($client->error) {
            return redirect()->route('users.index')->with([
                'notification' => $client->error,
                'type-notification' => 'danger'
            ]);
        }

        return redirect()->route('users.index')->with([
            'notification' => trans('messages.notification.user_saved'),
            'type-notification' => 'success'
        ]);

    }


    public function edit(User $user)
    {
        $company = Company::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'company' => $company,
            'edit' => true
        ]);

    }


    public function update(User $user, Request $request)
    {

        $this->validation($request, $user);

        $fields = $request->all();

        $arrayAttributes = $this->prepareAttributes($fields);

        $fields['profile'] = json_encode($arrayAttributes);

        $user->update($fields);

        $client = new Cognito();
        $us = $client->getUser($user->sub);

        $client->updateUser($user->sub, $arrayAttributes);

        if (isset($fields['brand_id'])) {
            $user->brand()->sync($fields['brand_id']);
            if ($user->is_owner) {
                $company = Company::find($fields['brand_id']);
                $company->owner_id = $user->id;
                $company->save();

                // Relation with all restaurant in company
                $restaurantIDs = $company->restaurants()->pluck('id');
                $user->restaurant()->sync($restaurantIDs);
            } else {
                if (isset($fields['restaurant_id'])) {
                    $user->restaurant()->sync($fields['restaurant_id']);
                } else {
                    $user->restaurant()->sync([]);
                }
            }

        } else {
            if (Auth::user()->is_super) {
                $user->restaurant()->sync([]);
                $user->brand()->sync([]);
                if ($user->company) {
                    $company = Company::find($user->company->id);
                    $company->owner_id = null;
                    $company->save();
                }
            }
        }

        if (!$user->is_owner) {
            $resetOwnerCompany = Company::where('owner_id', $user->id)->first();
            if ($resetOwnerCompany) {
                $resetOwnerCompany->owner_id = null;
                $resetOwnerCompany->save();
            }
        }

        return redirect()->route('users.index')->with([
            'notification' => trans('messages.notification.user_saved'),
            'type-notification' => 'success'
        ]);

    }


    public function destroy(User $user)
    {

        $companies = Company::where('owner_id', $user->id)->get();
        $companies->map(function ($company) {
            $company->owner_id = null;
            $company->save();
        });
        $client = new Cognito();
        $client->deleteUser($user->sub);

        //Obfuscate the email
        $user->update(['email' => (string)Str::uuid()]);
        $user->delete();

        return redirect()->route('users.index')->with('notification', 'User removed with success!')->with('type-notification', 'danger');

    }


    public function restore(User $user)
    {

        $user->restore();

        return redirect()->route('users.index')->with('notification', 'User restored with success!')->with('type-notification', 'success');

    }


    /**
     * Prepare attributes to send in Cognito format
     *
     * @return Array
     */
    protected function prepareAttributes($fields)
    {

        $attributes = config('cognito.user_attributes');

        $saveAttributes = array();

        foreach ($attributes as $attr) {

            $field = str_replace('custom:', '', $attr);

            if (isset($fields[$field])) {
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
    protected function alignUsersFromCognito()
    {

        $collection = new Collection();
        $client = new Cognito();
        $cognito = $client->listUser();

        foreach ($cognito['Users'] as $cognitoUser) {

            $sub = $cognitoUser['Username'];


            $attributes = $cognitoUser['Attributes'];

            $email = $client->search('email', $attributes);

            $user = User::withTrashed()->where('email', $email)->first();

            if (!$user) {

                $user = new User;
                $user->password = bcrypt(Str::random(12)); // create random password only for DB, when user login, it ill update with the true one
                $user->email = $client->search('email', $attributes);

                $user->created_at = $cognitoUser['UserCreateDate'];


            }

            $user->sub = $sub;
            $user->updated_at = $cognitoUser['UserLastModifiedDate'];
            $user->role = $client->search('custom:role', $attributes) ?? 'CUSTOMER';

            $profile = array();
            foreach (config('cognito.user_attributes') as $attribute) {

                $item = str_replace('custom:', '', $attribute);
                $profile[$item] = $client->search($attribute, $attributes);

            }

            $user->profile = json_encode($profile);
            $user->deleted_at = NULL;
            $user->save();


            $collection = $collection->merge($user->id);

        }

        //$this->removeUsersDeletedInCognito($collection);


    }


    /**
     * Remove users from database whose not found in Cognito
     *
     * @return Array
     */
    protected function removeUsersDeletedInCognito($collection)
    {

        $users = User::whereNotIn('id', $collection->all())->get();


        $users->map(function ($user, $key) {
            $this->destroy($user);
        });

    }


}
