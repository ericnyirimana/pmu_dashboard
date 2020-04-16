<?php

namespace App\Http\Controllers;

use App\Libraries\StripeIntegration;
use App\Models\ClosedDay;
use App\Models\Company;
use App\Models\Mealtype;
use App\Models\Media;
use App\Models\OpeningHour;
use App\Models\Restaurant;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

          return view('admin.restaurants.index')
              ->with(compact('restaurants'));

      }


      public function create(Company $company)
      {

          $mealtypeList = $this->prepareMealTypeList();
          $restaurant = new Restaurant;
          $media = Media::whereNull('brand_id')->orWhere('brand_id', $company->id)->get();


          return view('admin.restaurants.create')->with([
              'company' => $company,
              'restaurant' => $restaurant,
              'media' => $media,
              'mealtype' => $mealtypeList
          ]);

      }


      public function store(Company $company, Request $request)
      {

          $this->validation($request);

          $fields = $request->all();

          $fields['brand_id'] = $company->id;

          // save on aux
          $openings = $fields['openings'];
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


      public function show(Restaurant $restaurant)
      {

          $company = $restaurant->company;

          return view('admin.restaurants.view')
              ->with(compact('restaurant'))
              ->with(compact('company'));

      }


      public function edit(Company $company, Restaurant $restaurant)
      {

          $mealtypeList = $this->prepareMealTypeList();

          $media = Media::whereNull('brand_id')->orWhere('brand_id', $company->id)->get();

          return view('admin.restaurants.edit')->with([
              'restaurant' => $restaurant,
              'company' => $company,
              'media' => $media,
              'mealtype' => $mealtypeList
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
        if (!$restaurant->stripe_account_id) {
            $accountStripe = $this->stripe->createAccount($restaurant);
            $restaurant->stripe_account_id = $accountStripe->id;

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
