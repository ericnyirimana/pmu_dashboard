<?php

namespace App\Http\Controllers;

use App\Libraries\StripeIntegration;
use App\Models\Showcase;
use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Restaurant;
use App\Models\OpeningHour;
use App\Models\ClosedDay;
use App\Models\Media;

use Carbon\Carbon;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{


    protected $company_path = '/app/public/restaurants/';
    protected $stripe;

    public function __construct(StripeIntegration $stripe) {
        $this->stripe = $stripe;
    }

      public function validation(Request $request, $company = null)
      {

          $request->validate(
              [
                  'name' => 'required',
              ]
          );

      }


      public function index()
      {

          $restaurants = Restaurant::all();

          $this->alignUsersFromCognito();



          if (Auth::user()->is_super) {
              $users = User::withTrashed()->get();
          } else {
              $users = User::get();
          }

          return view('admin.restaurants.index')
              ->with(compact('restaurants'))
              ->with(compact('users'));

      }


      public function create(Company $company)
      {

          $restaurant = new Restaurant;
          $media = Media::whereNull('brand_id')->orWhere('brand_id', $company->id)->get();
          $user = User::get();

          return view('admin.restaurants.create')->with([
              'company' => $company,
              'restaurant' => $restaurant,
              'media' => $media,
              'user'  => $user
          ]);

      }


      public function store(Company $company, Request $request)
      {

          $this->validation($request);

          $fields = $request->all();

          $fields['brand_id'] = $company->id;

          // save on aux
          $openings = $fields['openings'];
          // save on aux
          $closings = $fields['closings'];

          // remove from fields to not conflict with Restaurant fields
          unset($fields['openings']);
          unset($fields['closings']);

          $restaurant = Restaurant::create($fields);
          $this->saveOpeningsHours($restaurant->id, $openings);
          $this->saveClosedDays($restaurant->id, $closings);
          $this->saveTimeslots($restaurant->id);

          if ($request->media) {
              $restaurant->media()->sync(array_unique($request->media));
          }

          //Create Stripe Account
          $this->createAccountStripe($restaurant);

          return redirect()->route('companies.show', $company)->with([
              'notification' => 'Restaurant saved with success!',
              'type-notification' => 'success'
          ]);

      }


      public function data(Company $company)
      {

          if ($company) {
              return response()->json($company->restaurants, 200);
          }


          return response()->json(['error' => 'No company selected'], 404);

      }


      public function show(Restaurant $restaurant, User $user)
      {

          $company = $restaurant->company;

          return view('admin.restaurants.view')
              ->with(compact('restaurant'))
              ->with(compact('company'))
              ->with(compact('user'));

      }


      public function edit(Company $company, Restaurant $restaurant, User $user)
      {

          $media = Media::whereNull('brand_id')->orWhere('brand_id', $company->id)->get();

          return view('admin.restaurants.edit')->with([
              'restaurant' => $restaurant,
              'company' => $company,
              'media' => $media,
              'user' => $user
          ]);

      }


      public function update(Request $request, Company $company, Restaurant $restaurant)
      {


          $this->validation($request, $restaurant);

          $fields = $request->all();

          // save on aux
          $openings = $fields['openings'];
          $closings = $fields['closings'];

          // remove from fields to not conflict with Restaurant fields
          unset($fields['openings']);
          unset($fields['closings']);

          $restaurant->update($fields);
          $this->saveOpeningsHours($restaurant->id, $openings);
          $this->saveClosedDays($restaurant->id, $closings);

          if ($request->media) {
              $restaurant->media()->sync(array_unique($request->media));
          }

          //Create Stripe Account
          $this->createAccountStripe($restaurant);

          return redirect()->route('companies.show', $company)->with([
              'notification' => 'Restaurant saved with success!',
              'type-notification' => 'success'
          ]);

      }


      public function destroy(Restaurant $restaurant)
      {

          $company = $restaurant->company;
          $restaurant->delete();

          return redirect()->route('companies.show', $company)->with([
              'notification' => 'Restaurant removed with success!',
              'type-notification' => 'warning'
          ]);

      }


      protected function saveOpeningsHours(int $restaurant, array $fields)
      {

          // clean all openings hours
          OpeningHour::where('restaurant_id', $restaurant)->delete();

          if ($fields) {
              foreach ($fields as $day => $list) {

                  $close = isset($list['closed']) ? true : false;

                  foreach ($list['times'] as $time) {

                      OpeningHour::create([
                          'restaurant_id' => $restaurant,
                          'day_of_week' => $day,
                          'hour_ini' => $time['from'],
                          'hour_end' => $time['to'],
                          'closed' => $close
                      ]);
                  }

              }
          }

      }


      protected function saveClosedDays(int $restaurant, array $fields)
      {

          // clean all openings hours
          ClosedDay::where('restaurant_id', $restaurant)->delete();

          if ($fields) {
              foreach ($fields as $day => $list) {

                  $repeat = isset($list['repeat']) ? true : false;

                  if (!empty($list['name']) && !empty($list['date'])) {
                      ClosedDay::create([
                          'restaurant_id' => $restaurant,
                          'name' => $list['name'],
                          'date' => Carbon::parse($list['date']),
                          'repeat' => $repeat
                      ]);
                  }

              }
          }

      }


    protected function saveTimeslots(int $restaurant)
    {

        // clean all openings hours
        Timeslot::where('restaurant_id', $restaurant)->delete();

        // create two default timeslots
        $timeslot1 = Timeslot::create([
            'restaurant_id' => $restaurant,
            'mealtype_id' => 1,
            'hour_ini' => '11:00',
            'hour_end' => '15:00',
            'fixed' => true,
            'identifier' => (string)Str::uuid()
        ]);

        $showcase1 = Showcase::find(1); //showcase pranzo
        $showcase1->timeslots()->sync($timeslot1, false);

        $timeslot2 = Timeslot::create([
            'restaurant_id' => $restaurant,
            'mealtype_id' => 2,
            'hour_ini' => '19:00',
            'hour_end' => '23:00',
            'fixed' => true,
            'identifier' => (string)Str::uuid()
        ]);

        $showcase2 = Showcase::find(2); //showcase cena
        $showcase2->timeslots()->sync($timeslot2, false);
    }

    /**
     * @param $restaurant
     */
    protected function createAccountStripe($restaurant): void
    {
        if (!$restaurant->stripe_account_id) {
            $accountStripe = $this->stripe->createAccount($restaurant);
            $restaurant->stripe_account_id = $accountStripe->id;

            $restaurant->save();
        }

    }


}
