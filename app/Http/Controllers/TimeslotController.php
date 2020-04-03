<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;


class TimeslotController extends Controller
{



  public function data(Restaurant $restaurant) {

        if($restaurant) {
        
            return response()->json($restaurant->timeslots , 200);
        }


        return response()->json(['erro' => 'No restaurant selected' ], 404);

  }

}
