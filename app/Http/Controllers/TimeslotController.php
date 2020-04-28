<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Timeslot;


class TimeslotController extends Controller
{

    public function __construct()
    {

        $this->authorizeResource(Timeslot::class);
    }

    public function index() {

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
