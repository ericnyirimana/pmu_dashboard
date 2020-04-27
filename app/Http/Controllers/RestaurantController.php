<?php

namespace App\Http\Controllers;

use App\Libraries\StripeIntegration;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ClosedDay;
use App\Models\Company;
use App\Models\Mealtype;
use App\Models\Media;
use App\Models\OpeningHour;
use App\Models\Restaurant;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Support\Collection;
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

          $mealtypeList = $this->prepareMealTypeList();
          $restaurant = new Restaurant;
          $media = Media::whereNull('brand_id')->orWhere('brand_id', $company->id)->get();
          $users = $restaurant->users();

          return view('admin.restaurants.create')->with([
              'company' => $company,
              'restaurant' => $restaurant,
              'media' => $media,
              'mealtype' => $mealtypeList,
              'users'  => $users
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
          $timeslots = $fields['timeslots'];

          // remove from fields to not conflict with Restaurant fields
          unset($fields['openings']);
          unset($fields['closings']);
          unset($fields['timeslots']);

          $restaurant = Restaurant::create($fields);

          $this->saveOpeningsHours($restaurant->id, $openings);
          $this->saveClosedDays($restaurant->id, $closings);
          $this->saveTimeslots($restaurant->id, $timeslots);

          if ($request->media) {
              $restaurant->media()->sync(array_unique($request->media));
          }

          //Create Stripe Account
          //$this->createAccountStripe($restaurant);

          return redirect()->route('companies.show', $company)->with([
              'notification' => 'Restaurant saved with success!',
              'type-notification' => 'success'
          ]);

      }


      public function data(Company $company, Request $request)
      {


          if ($request->showedin) {
              $restaurants = new Collection();
              switch ($request->showedin) {
                  case 'menu':
                      $company->restaurants->map(function ($restaurant) use ($restaurants) {
                          if (!$restaurant->menu()->exists()) {
                              $restaurants->push($restaurant);
                          }
                      });
                      break;
                  default:
                      $restaurants = $company->restaurants;
                      break;
              }

              if ($restaurants->count() > 0) {
                  return response()->json($restaurants, 200);
              } else {
                  return response()->json(['error' => 'No restaurant without menu found'], 404);
              }
          }
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


      public function edit(Company $company, Restaurant $restaurant)
      {

          $mealtypeList = $this->prepareMealTypeList();

          $media = Media::whereNull('brand_id')->orWhere('brand_id', $company->id)->get();
          $company = $restaurant->company;
          $owner = $company->owner()->get();
          $users = $restaurant->users()->get();
         $users = $users->merge($owner);
          return view('admin.restaurants.edit')->with([
              'restaurant' => $restaurant,
              'company' => $company,
              'media' => $media,
              'mealtype' => $mealtypeList,
              'users' => $users
          ]);

      }


      public function update(Request $request, Company $company, Restaurant $restaurant)
      {


          $this->validation($request, $restaurant);

          $fields = $request->all();

          // save on aux
          $openings = $fields['openings'];
          $closings = $fields['closings'];
          $timeslots = $fields['timeslots'];

          // remove from fields to not conflict with Restaurant fields
          unset($fields['openings']);
          unset($fields['closings']);
          unset($fields['timeslots']);

          $restaurant->update($fields);
          $this->saveOpeningsHours($restaurant->id, $openings);
          $this->saveClosedDays($restaurant->id, $closings);
          $this->saveTimeslots($restaurant->id, $timeslots);

          if ($request->media) {
              $restaurant->media()->sync(array_unique($request->media));
          }

          //Create Stripe Account
          //$this->createAccountStripe($restaurant);

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


    protected function saveTimeslots(int $restaurant, array $fields)
    {

        // clean all timeslots
        Timeslot::where('restaurant_id', $restaurant)->delete();

        if ($fields) {
            foreach ($fields as $item) {
                $mealtype = Mealtype::find($item);
                if (!empty($mealtype)) {
                    Timeslot::create([
                        'restaurant_id' => $restaurant,
                        'mealtype_id' => $mealtype->id,
                        'hour_ini' => Carbon::parse($mealtype->hour_ini),
                        'hour_end' => Carbon::parse($mealtype->hour_end),
                        'fixed' => true,
                        'identifier' => (string)Str::uuid(),
                    ]);
                }

            }
        }

    }

    /**
     * @param $restaurant
     */
    protected function createAccountStripe($restaurant): void
    {
        if (!$restaurant->merchant_stripe) {
            $accountStripe = $this->stripe->createAccount($restaurant);
            $restaurant->merchant_stripe = $accountStripe->id;

            $restaurant->save();
        }

    }

    /**
     * @return Collection
     */
    protected function prepareMealTypeList(): Collection
    {
        $mealtype = Mealtype::all();


        $mealtypeList = new Collection();

        $mealtype->map(function ($mealtypeItem) use ($mealtypeList) {
            $mealtypeList[$mealtypeItem->id] = $mealtypeItem->name;
        });
        return $mealtypeList;
    }


}
