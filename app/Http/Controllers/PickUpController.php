<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Pickup;
use App\Models\Timeslot;
use App\Traits\TranslationTrait;
use Carbon\Carbon;

use Auth;

class PickupController extends Controller
{

    use TranslationTrait;


    public function __construct() {

      $this->authorizeResource(Pickup::class);

    }


    public function validation(Request $request, $pickup = null) {

        $validation = [
          'name'          => 'required',
          'type_pickup'   => 'required',
          'brand_id'      => ['required', new \App\Rules\CompanyBelongsToOwner],
          'restaurant_id' => ['required', new \App\Rules\RestaurantBelongsToCompany],
          'date'          => ['required'],
          'timeslot_id'   => ['required', new \App\Rules\TimeslotBelongsToRestaurant],

        ];

        if ($pickup) {
          $validation += [
            'price'         => ['required', 'integer'],
            'products'      => ['required', 'array'],
            'quantity_offer' => ['required', 'integer']
          ];

          unset($validation['type_pickup']);
        }

        $request->validate(
            $validation
        );

    }



    public function index() {

        if (Auth::user()->is_super) {
          $pickups = Pickup::all();

        } else {

          $pickups = Auth::all();
        }

        return view('admin.pickups.index')
        ->with( compact('pickups') );

    }


    public function create() {

          $pickup = new Pickup;
          return view('admin.pickups.create')->with([
                'pickup' => $pickup
            ]
          );

    }


    public function store(Request $request) {

          $inputs = $request->all();

          $this->validation($request);

          $fields = $request->all();

          $dates = explode('-', $fields['date']);
          $fields['date_ini'] = Carbon::parse($dates[0]);
          $fields['date_end'] = Carbon::parse($dates[1]);

          $pickup = Pickup::create($fields);
          if($pickup->type_pickup == 'offer') {
            $pickup->offer()->create(['type_offer' => 'simple', 'quantity_offer' => '10', 'price' => 7]);
          } else {
            $pickup->subscription()->create(['type_offer' => 'simple', 'quantity_offer' => '10', 'price' => 7, 'validate_days' => 5]);
          }
          $this->saveTranslation($pickup, $fields);



          return redirect()->route('pickups.edit', $pickup)->with([
                'notification' => 'Pickup saved with success!',
                'type-notification' => 'success'
              ]);

    }

    public function show(Pickup $pickup) {

          return view('admin.pickups.view')->with([
            'pickup'     => $pickup,
          ]
          );

    }


    public function edit(Pickup $pickup) {

      $menu = $pickup->restaurant->menu;

      return view('admin.pickups.edit')->with([
        'pickup'     => $pickup,
        'menu'  => $menu,
      ]
      );

    }



    public function update(Request $request, Pickup $pickup) {

          $this->validation($request, $pickup);

          $fields = $request->all();

          $dates = explode('|', $fields['date']);

          $fields['date_ini'] = Carbon::parse($dates[0]);
          $fields['date_end'] = Carbon::parse($dates[1]);


          $pickup->update($fields);

          if($pickup->type_pickup == 'offer') {
              $pickup->offer->update($fields);
          } else {
              $pickup->subscription->update($fields);
          }

          foreach($fields['products'] as $k=>$v) {

              $products[$v] = ['quantity_offer' => $fields['quantity'][$k]];
          }

          $this->saveTranslation($pickup, $fields);
          $pickup->products()->sync($products);

          if ($request->media) {
              $pickup->media()->sync( array_unique($request->media) );
          }

          return redirect()->route('pickups.index')->with([
                'notification' => 'Pickup saved with success!',
                'type-notification' => 'success'
              ]);

    }


    public function destroy(Pickup $pickup) {

          $pickup->delete();

          return redirect()->route('pickups.index')->with([
                'notification' => 'Image removed with success!',
                'type-notification' => 'warning'
              ]);

    }


}
