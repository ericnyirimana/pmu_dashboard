<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Timeslot;


class TimeslotController extends Controller
{

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

        $timeslot = Timeslot::all();

        return view('admin.timeslots.index')
            ->with(compact('timeslot'));

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

    public function show(Timeslot $timeslot) {

        return view('admin.timeslots.view')->with([
                'timeslot'     => $timeslot,
            ]
        );

    }


    public function edit(Timeslot $timeslot) {

        return view('admin.timeslots.edit')->with([
                'timeslot'     => $timeslot,
            ]
        );

    }


    public function update(Request $request, Timeslot $timeslot) {

        $this->validation($request, $timeslot);

        $fields = $request->all();

        $timeslot->update($fields);

        return redirect()->route('timeslots.index')->with([
            'notification' => 'Orario salvato con successo!',
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
