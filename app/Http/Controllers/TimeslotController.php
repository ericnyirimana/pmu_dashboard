<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Timeslot;
use Auth;


class TimeslotController extends Controller
{

    public function __construct()
    {

        $this->authorizeResource(Timeslot::class);
    }

    public function index() {
        if (Auth::user()->is_restaurant) {
            $timeslots = Timeslot::where('restaurant_id', Auth::user()->restaurant->first()->id);
        } else {
            $timeslots = Timeslot::all();
        }

        return view('admin.timeslots.index')
            ->with(compact('timeslots'));
    }

    public function create() {}

    public function data(Restaurant $restaurant)
    {

        if ($restaurant) {

            return response()->json($restaurant->timeslots, 200);
        }

        return response()->json(['error' => 'No restaurant selected'], 404);

    }

}
