<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Restaurant;
use App\Models\OpeningHour;
use App\Models\ClosedDay;
use App\Models\Media;

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

            $restaurant = new Restaurant;
            $media = Media::whereNull('brand_id')->orWhere('brand_id', $brand->id)->get();


            return view('admin.restaurants.create')->with([
              'brand'     => $brand,
              'restaurant'     => $restaurant,
              'media'     => $media,
              ]);

      }


      public function store(Brand $brand, Request $request) {

            $this->validation($request);

            $fields = $request->all();

            $fields['brand_id'] = $brand->id;

            // save on aux
            $openings = $fields['openings'];

            // save on aux
            $closings = $fields['closings'];

            // remove from fields to not conflict with Restaurant fields
            unset($fields['openings']);
            unset($fields['closings']);

            $restaurant = Restaurant::create($fields);

            $this->saveOpeningsHours($restaurant->id, $openings);
            $this->saveClosedDays($restaurant->id, $closings);

            if ($request->media) {
                $restaurant->media()->sync( array_unique($request->media) );
            }

            return redirect()->route('brands.show', $brand)->with([
                  'notification' => 'Restaurant saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function data(Brand $brand) {

            if($brand) {
                return response()->json($brand->restaurants , 200);
            }


            return response()->json(['erro' => 'No company selected' ], 404);

      }


      public function show(Restaurant $restaurant) {

            $brand = $restaurant->brand;

            return view('admin.restaurants.view')
            ->with( compact('restaurant') )
            ->with( compact('brand') );

      }


      public function edit(Brand $brand, Restaurant $restaurant) {

            $media = Media::whereNull('brand_id')->orWhere('brand_id', $brand->id)->get();

            return view('admin.restaurants.edit')->with([
              'restaurant'     => $restaurant,
              'brand'     => $brand,
              'media'     => $media,
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
            unset($fields['closings']);

            $restaurant->update($fields);

            $this->saveOpeningsHours($restaurant->id, $openings);
            $this->saveClosedDays($restaurant->id, $closings);

            if ($request->media) {
                $restaurant->media()->sync( array_unique($request->media) );
            }

            return redirect()->route('brands.show', $brand)->with([
                  'notification' => 'Restaurant saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Restaurant $restaurant) {

            $brand = $restaurant->brand;
            $restaurant->delete();

            return redirect()->route('brands.show', $brand)->with([
                  'notification' => 'Restaurant removed with success!',
                  'type-notification' => 'warning'
                ]);

      }


      protected function saveOpeningsHours(int $restaurant, array $fields) {

            // clean all openings hours
            OpeningHour::where('restaurant_id', $restaurant)->delete();

            if ($fields) {
              foreach ($fields as $day => $list) {

                  $close = isset($list['closed']) ? true : false;

                  foreach ($list['times'] as $time) {

                      OpeningHour::create([
                        'restaurant_id' => $restaurant,
                        'day_of_week'   => $day,
                        'hour_ini'     => $time['from'],
                        'hour_end'       => $time['to'],
                        'closed'        => $close
                      ]);
                  }

              }
            }

      }


      protected function saveClosedDays(int $restaurant, array $fields) {

        // clean all openings hours
        ClosedDay::where('restaurant_id', $restaurant)->delete();

        if ($fields) {
            foreach ($fields as $day => $list) {

                $repeat = isset($list['repeat']) ? true : false;

                if (!empty($list['name']) && !empty($list['date'])) {
                  $closed = ClosedDay::create([
                    'restaurant_id' => $restaurant,
                    'name'          => $list['name'],
                    'date'          => Carbon::parse($list['date']),
                    'repeat'        => $repeat
                  ]);
              }

            }
        }

      }





}
