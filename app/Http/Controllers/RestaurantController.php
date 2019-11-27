<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{



      protected $brand_path = '/app/public/restaurants/';



      public function validation(Request $request, $brand = null) {

          $request->validate(
            [
              'image'  => (empty($brand)?'required|':'').'image|mimes:jpeg,bmp,png',
              'name'  => 'required',
              'vat'   => 'required'
            ]
          );

      }


      public function index() {

          $restaurants = Restaurant::all();

          return view('admin.restaurants.index')
          ->with( compact('restaurants') );

      }


}
