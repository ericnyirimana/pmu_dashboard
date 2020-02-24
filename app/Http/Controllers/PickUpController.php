<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Pickup;
use App\Models\Timeslot;
use App\Traits\TranslationTrait;


use Auth;

class PickupController extends Controller
{

    use TranslationTrait;


    public function __construct() {

      $this->authorizeResource(Pickup::class);

    }


    public function validation(Request $request, $media = null) {

        $request->validate(
          [
            'name'  => 'required',
          ]
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

          return view('admin.pickups.create')->with([

            ]
          );

    }


    public function store(Request $request) {

          $inputs = $request->all();

          $this->validation($request);

          $fields = $request->all();


          $pickup = Pickup::create($fields);

          $this->saveTranslation($pickup, $fields);
          $this->products()->sync($fields['products']);

          if ($request->media) {
              $pickup->media()->sync( array_unique($request->media) );
          }

          return redirect()->route('pickups.index')->with([
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

      $timeslots = Timeslot::get();
      $menu = $pickup->restaurant->menu;

      return view('admin.pickups.edit')->with([
        'pickup'     => $pickup,
        'timeslots'  => $timeslots,
        'menu'  => $menu,
      ]
      );

    }

    public function update(Request $request, Pickup $pickup) {

          $this->validation($request, $pickup);

          $fields = $request->all();

          $pickup->update($fields);

          $this->saveTranslation($pickup, $fields);
          $pickup->products()->sync($fields['products']);

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
