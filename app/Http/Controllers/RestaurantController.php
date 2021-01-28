<?php

namespace App\Http\Controllers;

use App\Libraries\StripeIntegration;
use App\Models\OrderPickup;
use App\Models\Pickup;
use App\Models\PickupSubscription;
use App\Models\SubscriptionTicket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ClosedDay;
use App\Models\Company;
use App\Models\Mealtype;
use App\Models\Media;
use App\Models\OpeningHour;
use App\Models\RestaurantTimeslot;
use App\Models\Restaurant;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{


    protected $company_path = '/app/public/restaurants/';
    protected $stripe;

    public function __construct(StripeIntegration $stripe)
    {
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
            'users' => $users,
        ]);

    }


    public function store(Company $company, Request $request)
    {

        $this->validation($request);

        $fields = $request->all();

        $fields['brand_id'] = $company->id;

        // save on aux
        if (isset($fields['openings'])) {
            $openings = $fields['openings'];
        }
        $closings = $fields['closings'];
        if (isset($fields['timeslots'])) {
            $timeslots = $fields['timeslots'];
        }

        // remove from fields to not conflict with Restaurant fields
        unset($fields['openings']);
        unset($fields['closings']);
        unset($fields['timeslots']);

        $restaurant = Restaurant::create($fields);

        if (isset($openings)) {
            $this->saveOpeningsHours($restaurant->id, $openings);
        }
        $this->saveClosedDays($restaurant->id, $closings);

        if (isset($restaurant->id, $timeslots)) {
            $this->saveTimeslots($restaurant->id, $timeslots);
        }

        if ($request->media) {
            $restaurant->media()->sync(array_unique($request->media));
        }

        //Assign new restaurant to owner
        $owner = $company->owner;
        if ($owner) {
            // Relation with all restaurant in company
            $restaurantIDs = $company->restaurants()->pluck('id');
            $restaurantIDs->push($restaurant->id);
            $owner->restaurant()->sync($restaurantIDs);
        }

        //Create Stripe Account
        //$this->createAccountStripe($restaurant);

        return redirect()->route('companies.show', $company)->with([
            'notification' => trans('messages.notification.restaurant_saved'),
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
                return response()->json(['error' => trans('errors.no_restaurant_without_menu')], 404);
            }
        }
        if ($company) {
            return response()->json($company->restaurants, 200);
        }


        return response()->json(['error' => trans('errors.no_company_selected')], 404);

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
        $mealtype = Mealtype::all();
        $payments = null;
        $balance = null;

        if (isset($restaurant->merchant_stripe)) {
            // List of payment/transfer
            $payouts = $this->stripe->getPayoutsForConnectedAccount($restaurant->merchant_stripe);
            $payments = new Collection();
            foreach ($payouts['data'] as $payout) {
                $payments->push((object)[
                    'id' => $payout->id,
                    'created' => date('d-m-Y', $payout->created),
                    'amount' => number_format(($payout->amount / 100), 2, ',', '.') . '€'
                ]);
            }

            //Balance
            $balance = $this->stripe->getBalanceForConnectedAccount($restaurant->merchant_stripe);
        }

        return view('admin.restaurants.edit')
            ->with([
                'restaurant' => $restaurant,
                'company' => $company,
                'media' => $media,
                'mealtype' => $mealtypeList,
                'mealtypeInfo' => $mealtype,
                'users' => $users,
                'payments' => $payments,
                'balance' => $balance,
            ]);

    }

    public function payment(Request $request)
    {
        $queryString = $request->all();
        if ($queryString['restaurant_id'] && $queryString['payout_id']) {


            $restaurant = Restaurant::find($queryString['restaurant_id'])->first();
            //payout detail
            $payout = $this->stripe->getPayoutDetail($queryString['payout_id'], $restaurant->merchant_stripe);

            $transfers = new Collection();
            $transfers = $this->stripe->getTransfersForBalanceTransaction($restaurant->merchant_stripe, $payout->balance_transaction);


            if ($restaurant) {
                return view('admin.restaurants.payment')->with([
                    'restaurant' => $restaurant,
                    'payout' => $payout,
                    'transfers' => $transfers
                ]);
            }

        } else {
            abort(404);
        }

    }


    public function update(Request $request, Company $company, Restaurant $restaurant)
    {


        $this->validation($request, $restaurant);

        $fields = $request->all();

        // save on aux
        if (isset($fields['openings'])) {
            $openings = $fields['openings'];
        }
        $closings = $fields['closings'];
        if (isset($fields['timeslots'])) {
            $timeslots = $fields['timeslots'];
        }

        // remove from fields to not conflict with Restaurant fields
        unset($fields['openings']);
        unset($fields['closings']);
        unset($fields['timeslots']);

        $restaurant->update($fields);
        if (isset($openings)) {
            $this->saveOpeningsHours($restaurant->id, $openings);
        }
        $this->saveClosedDays($restaurant->id, $closings);

        if (isset($restaurant->id, $timeslots)) {
            $this->saveTimeslots($restaurant->id, $timeslots);
        }

        if ($request->media) {
            $restaurant->media()->sync(array_unique($request->media));
        }

        //Create Stripe Account
        //$this->createAccountStripe($restaurant);

        return redirect()->route('companies.show', $company)->with([
            'notification' => trans('messages.notification.restaurant_saved'),
            'type-notification' => 'success'
        ]);

    }


    public function destroy(Restaurant $restaurant)
    {

        $company = $restaurant->company;
        $restaurant->delete();

        return redirect()->route('companies.show', $company)->with([
            'notification' => trans('messages.notification.restaurant_removed'),
            'type-notification' => 'warning'
        ]);

    }


    protected function saveOpeningsHours(int $restaurant, $fields)
    {

        if ($fields) {
            $checkRestaurant = RestaurantTimeslot::where('restaurant_id', $restaurant)->count();
            if ($checkRestaurant > 0) {
                RestaurantTimeslot::where('restaurant_id', $restaurant)->update([
                    'restaurant_id' => $restaurant,
                    'timeslots' => json_encode($fields),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null,
                ]);
            }
            else{
                RestaurantTimeslot::create([
                    'restaurant_id' => $restaurant,
                    'timeslots' => json_encode($fields),
                    'created_at' => Carbon::now(),
                ]);
            }

        }

    }


    protected function saveClosedDays(int $restaurant, array $fields)
    {

        if ($fields) {
            // clean all openings hours
            ClosedDay::where('restaurant_id', $restaurant)->delete();

            foreach ($fields as $day => $list) {

                // $repeat = isset($list['repeat']) ? true : false;

                if (!empty($list['dates'])) {
                    $dates = explode(' -', $list['dates']);
                    $fromDate = Carbon::parse($dates[0]);
                    $toDate = Carbon::parse($dates[1]);
                    ClosedDay::create([
                        'restaurant_id' => $restaurant,
                        'name' => $list['name'],
                        'date_from' => $fromDate,
                        'date_to' => $toDate,
                        'repeat' => false
                    ]);
                }

            }
        }

    }


    protected function saveTimeslots(int $restaurant, array $fields)
    {

        if ($fields) {

            $timeslots = Timeslot::where('restaurant_id', $restaurant)->get();
            $listUnchecked = array();
            $listChecked = array();
            foreach ($fields as $key => $value) {
                if (strpos($value, "false") !== false) {
                    settype($value, "integer");
                    $listUnchecked[] = $value;
                    unset($fields[$key]);
                }
            }
            foreach ($fields as $field => $checkedValue) {
                settype($checkedValue, "integer");
                array_push($listChecked, $checkedValue);
            }
            $timeslotIds = $timeslots->pluck('mealtype_id')->toArray();
            if ($timeslots->count() > 0) {
                $timeslots->map(function ($timeslot) use ($listChecked) {
                    if (!in_array($timeslot->mealtype->id, $listChecked)) {
                        Timeslot::find($timeslot->id)->delete();
                    } else {

                    }
                });
            }   
            foreach ($listChecked as $item) {
                $mealtype = Mealtype::find($item);
                if (!empty($mealtype)) {
                    if (!Timeslot::withTrashed()->where('restaurant_id', $restaurant)->where('mealtype_id',
                    $mealtype->id)->first()) {
                        Timeslot::create(
                            ['restaurant_id' => (int)$restaurant, 'mealtype_id' => (int)$mealtype->id,
                            'hour_ini' => $mealtype->hour_ini,
                            'hour_end' => $mealtype->hour_end,
                            'fixed' => true,
                            'identifier' => (string)Str::uuid(),
                            'deleted_at' => null]
                        );
                    }
                    else {
                        Timeslot::withTrashed()->where('restaurant_id', (int)$restaurant)
                                ->where('mealtype_id', (int)$mealtype->id)
                                ->update(['deleted_at' => null]);
                    }
                }


            }
            $restaurantTimeslots = RestaurantTimeslot::where('restaurant_id', $restaurant)->get();
            if ($restaurantTimeslots->count() == 0 || empty($restaurantTimeslots->first()->timeslots)) {
                $allDays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                $list = array();
                $timeslotsJson = array();
                    $listMealtype = array();
                    foreach ($listChecked as $items) {
                        $mealtype = Mealtype::find($items);
                        $mealtypeJson =  [
                                'id' => $mealtype->id,
                                'name' => $mealtype->name,
                                'hours' => [
                                    'hour_ini' => $mealtype->hour_ini,
                                    'hour_end' => $mealtype->hour_end,
                                ]
                        ];
                        array_push($listMealtype, $mealtypeJson);
                    }
                    $timeslotsJson = ['mealtypes' => $listMealtype];
                    $newTimeslot = array_fill_keys($allDays, $timeslotsJson);
                RestaurantTimeslot::updateOrCreate(['restaurant_id' => (int)$restaurant],
                    ['timeslots' => $newTimeslot,
                    'created_at' => Carbon::now(),
                ]);
            }
            else {
                if (!empty($listUnchecked)) {    
                    $timeslotsToArray = $restaurantTimeslots->first()->timeslots;
                    foreach ($listUnchecked as $uncheckedField => $uncheckedFieldValue) {
                        foreach ($timeslotsToArray as $days => $dayValues) {
                            $mealtypeOrderIndex = $timeslotsToArray[$days]['mealtypes'];
                            foreach ($dayValues['mealtypes'] as $meal => $mealtypeValue) {
                                if ($mealtypeValue['id'] == $uncheckedFieldValue) {
                                    unset($timeslotsToArray[$days]['mealtypes'][$meal]);
                                }
                            }
                            $mealtypeOrderIndex = array_values($timeslotsToArray[$days]['mealtypes']);
                            $timeslotsToArray[$days]['mealtypes'] = array();
                            array_push($timeslotsToArray[$days]['mealtypes'], $mealtypeOrderIndex);
                            $timeslotsToArray[$days]['mealtypes'] = $timeslotsToArray[$days]['mealtypes'][0];

                        }
                    }
                    RestaurantTimeslot::where('restaurant_id', $restaurant)->update(['timeslots' => json_encode($timeslotsToArray)]);
                }
                if (!empty($listChecked)) { 
                    $newRestaurantTimeslots = RestaurantTimeslot::where('restaurant_id', $restaurant)->get();
                    $newtimeslotsToArray = $newRestaurantTimeslots->first()->timeslots;
                    $newMealtype = array();
                    foreach ($listChecked as $checkedField => $checkedFieldValue) {
                        if(!in_array($checkedFieldValue, $timeslotIds, false)){
                        $mealtype = Mealtype::find($checkedFieldValue);
                            foreach ($newtimeslotsToArray as $timeslotsAllDay => $timeslotDayValue) {
                                $newMealtypeJson =  [
                                    'id' => $mealtype->id,
                                    'name' => $mealtype->name,
                                    'hours' => [
                                        'hour_ini' => $mealtype->hour_ini,
                                        'hour_end' => $mealtype->hour_end,
                                    ]
                                ];
                                array_push($newtimeslotsToArray[$timeslotsAllDay]['mealtypes'], $newMealtypeJson);
                            }
                        }
                    }
                    RestaurantTimeslot::where('restaurant_id', $restaurant)->update(['timeslots' => json_encode($newtimeslotsToArray)]);
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
