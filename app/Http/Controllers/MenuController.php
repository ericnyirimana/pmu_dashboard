<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Brand;
use App\Models\Restaurant;
use App\Models\Product;

use Auth;

class MenuController extends Controller
{


    public function __construct() {

      $this->authorizeResource(Menu::class);

    }

    public function validation(Request $request) {

        $request->validate(
          [
            'name'          => 'required',
            'restaurant_id' => new \App\Rules\RestaurantBelongsToBrand,
          ]
        );

    }


    public function index() {

        if (Auth::user()->is_super) {
            $menu = Menu::all();
        }


        if (Auth::user()->is_owner) {
            $menu = Menu::whereHas('restaurant', function($q){
              $q->whereHas('brand', function($q){
                $q->where('owner_id', Auth::user()->id);
              });
            })->get();
        }

        if (Auth::user()->is_restaurant) {
            return redirect( route('menu.edit', $this->getFirstMenuFromRestaurant() ));
        }

        return view('admin.menu.index')
        ->with( compact('menu') );

    }


    public function create() {

          $menu = new Menu;
          $brands = Brand::all();
          $restaurants = Restaurant::all();

          return view('admin.menu.create')->with([
            'menu'   => $menu,
            'brands'   => $brands,
            'restaurants'   => $restaurants,
          ]
          );

    }


    public function store(Request $request) {

          $this->validation($request);

          $fields = $request->all();

          $menu = Menu::create($fields);

          return redirect()->route('menu.edit', $menu)->with([
                'notification' => 'Menu saved with success!',
                'type-notification' => 'success'
              ]);

    }


    public function show(Menu $menu) {


          return view('admin.menu.view')->with([
            'menu'     => $menu,
            'users'     => $users,
            'media'     => $media
          ]
          );

    }


    public function edit(Menu $menu) {

          if (Auth::user()->is_super) {
            $brands = Brand::all();
            $restaurants = Restaurant::all();
          } else {
            $brands = Auth::user()->brand;
            $restaurants = Auth::user()->brand->restaurants;
          }

          $dishesProducts = $menu->products()->where('type', 'Dish')->get();
          $drinksProducts = $menu->products()->where('type', 'Drink')->get();


          return view('admin.menu.edit')->with([
            'menu'    => $menu,
            'brands'  => $brands,
            'restaurants' => $restaurants,
            'dishesProducts' => $dishesProducts,
            'drinksProducts' => $drinksProducts
          ]
          );

    }

    public function update(Request $request, Menu $menu) {

          $this->validation($request, $menu);

          $fields = $request->all();

          $fields['status'] = $request->status ? true : false;

          $menu->update($fields);

          return redirect()->route('menu.edit', $menu)->with([
                'notification' => 'Menu saved with success!',
                'type-notification' => 'success'
              ]);

    }


    public function destroy(Menu $menu) {

          $menu->delete();

          return redirect()->route('menu.index')->with([
                'notification' => 'Image removed with success!',
                'type-notification' => 'warning'
              ]);

    }


    protected function getFirstMenuFromRestaurant() {

        $user = Auth::user();

        $menu = Menu::first();

        return $menu;

    }




}
