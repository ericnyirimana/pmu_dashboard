<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Timeslot;
use App\Traits\TranslationTrait;


class TimeslotController extends Controller
{

    use TranslationTrait;

//    public function __construct() {
//
//        $this->authorizeResource(Timeslot::class);
//
//    }

    public function validation(Request $request) {

        $validation = [
            'mealtype_id'  => 'required',
            'range_clock'     => 'required'

        ];

        $request->validate(
            $validation
        );

    }

    public function index()
    {

        $timeslots = Timeslot::all();

        return view('admin.timeslots.index')
            ->with(compact('timeslots'));

    }

    public function create() {

        $timeslot = new Timeslot();

        return view('admin.timeslots.create')->with([
                'timeslot'   => $timeslot

            ]
        );

    }

    public function store(Request $request)
    {

        $this->validation($request);

        $fields = $request->all();

        $timeslot = Timeslot::create($fields);

        return redirect()->route('timeslots.edit', $timeslot)->with([
            'notification' => 'Nuovo orario salvato con successo!',
            'type-notification' => 'success'
        ]);

    }

  public function data(Restaurant $restaurant) {

        if($restaurant) {
        
            return response()->json($restaurant->timeslots , 200);
        }


        return response()->json(['error' => 'No restaurant selected' ], 404);

  }

    public function destroy(Timeslot $timeslot) {

        $timeslot->delete();

        return redirect()->route('timeslots.index')->with([
            'notification' => 'Orario rimosso con successo!',
            'type-notification' => 'warning'
        ]);

    }

}
