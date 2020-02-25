<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Timeslot;


class TimeslotController extends Controller
{



  public function data(Restaurant $restaurant) {

        if($restaurant) {
        
            return response()->json($restaurant->timeslots , 200);
        }


        return response()->json(['erro' => 'No restaurant selected' ], 404);

  }

}
