<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Restaurant;
use App\Models\OpeningHour;
use App\Models\ClosedDay;

use Carbon\Carbon;

class RestaurantController extends Controller
{



      protected $brand_path = '/app/public/restaurants/';



      public function validation(Request $request, $brand = null) {

          $request->validate(
            [
              'name'  => 'required',
            ]
          );

      }


      public function index() {

          $restaurants = Restaurant::all();

          return view('admin.restaurants.index')
          ->with( compact('restaurants') );

      }


      public function create(Brand $brand) {

            $restaurant = null;

            return view('admin.restaurants.form')->with([
              'brand'     => $brand,
              'restaurant'     => $restaurant,
              ]);

      }


      public function store(Brand $brand, Request $request) {

            $this->validation($request);

            $fields = $request->all();

            $fields['brand_id'] = $brand->id;

            // save on aux
            $openings = $fields['openings'];

            // remove from fields to not conflict with Restaurant fields
            unset($fields['openings']);

            $restaurant = Restaurant::create($fields);

            $this->saveOpeningsHours($restaurant->id, $openings);

            return redirect()->route('brand.restaurants.index', $brand)->with([
                  'notification' => 'Restaurant saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function edit(Brand $brand, Restaurant $restaurant) {


            return view('admin.restaurants.form')->with([
              'restaurant'     => $restaurant,
              'brand'     => $brand,
              ]);

      }


      public function update(Request $request, Brand $brand, Restaurant $restaurant) {


            $this->validation($request, $restaurant);

            $fields = $request->all();

            // save on aux
            $openings = $fields['openings'];
            $closings = $fields['closings'];

            // remove from fields to not conflict with Restaurant fields
            unset($fields['openings']);

            $restaurant->update($fields);

            $this->saveOpeningsHours($restaurant->id, $openings);
            $this->saveClosedDays($restaurant->id, $closings);

            return redirect()->route('brand.restaurants.index', $brand)->with([
                  'notification' => 'Restaurant saved with success!',
                  'type-notification' => 'success'
                ]);

      }



      protected function saveOpeningsHours(int $restaurant, array $fields) {

        // clean all openings hours
        OpeningHour::where('restaurant_id', $restaurant)->delete();

        foreach ($fields as $day => $list) {

            $close = isset($list['closed']) ? true : false;

            foreach ($list['times'] as $time) {

                OpeningHour::create([
                  'restaurant_id' => $restaurant,
                  'day_of_week'   => $day,
                  'hour_from'     => $time['from'],
                  'hour_to'       => $time['to'],
                  'closed'        => $close
                ]);
            }


        }

      }


      protected function saveClosedDays(int $restaurant, array $fields) {

        // clean all openings hours
        ClosedDay::where('restaurant_id', $restaurant)->delete();

        foreach ($fields as $day => $list) {

            $repeat = isset($list['repeat']) ? true : false;

            $closed = ClosedDay::create([
              'restaurant_id' => $restaurant,
              'name'          => $list['name'],
              'date'          => Carbon::parse($list['date']),
              'repeat'        => $repeat
            ]);


        }

      }


}
