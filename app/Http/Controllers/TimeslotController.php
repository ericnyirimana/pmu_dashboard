<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mealtype;
use App\Models\Timeslot;
use App\Traits\TranslationTrait;
use App\Models\Restaurant;


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
            'id',
            'name',
            'range_clock'     => 'required'
        ];

        $request->validate(
            $validation
        );

    }

    public function index()
    {

        $timeslot = Timeslot::all();
        $mealtype = Mealtype::all();

        return view('admin.timeslots.index')
            ->with(compact('timeslot'))
            ->with(compact('mealtype'));

    }

    public function create() {

        $timeslot = new Timeslot();
        $mealtype = new Mealtype();

        return view('admin.timeslots.create')->with([
                'timeslot'   => $timeslot,
                'mealtype'   => $mealtype
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

    public function show(Timeslot $timeslot, Mealtype $mealtype) {

        return view('admin.timeslots.view')->with([
                'timeslot'  => $timeslot,
                'mealtype'  => $mealtype
            ]
        );

    }


    public function edit(Timeslot $timeslot, Mealtype $mealtype) {

        return view('admin.timeslots.edit')->with([
                'timeslot'  => $timeslot,
                'mealtype'  => $mealtype
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
