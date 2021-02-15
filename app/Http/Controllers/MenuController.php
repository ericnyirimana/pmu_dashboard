<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Menu;
use App\Models\Restaurant;
use Auth;
use Illuminate\Http\Request;

class MenuController extends Controller
{


    public function __construct()
    {

        $this->authorizeResource(Menu::class);

    }

    public function validation(Request $request)
    {

        $request->validate(
            [
                'name' => 'required',
                'restaurant_id' => new \App\Rules\RestaurantBelongsToCompany,
            ]
        );

    }


    public function index()
    {

        if (Auth::user()->is_super) {
            $menu = Menu::whereHas('restaurant')
            ->orderByRaw('FIELD(status_menu, "PENDING","DRAFT","APPROVED")')
            ->get();
        }


        if (Auth::user()->is_owner) {
            $menu = Menu::whereHas('restaurant', function ($q) {
                $q->whereHas('company', function ($q) {
                    $q->where('owner_id', Auth::user()->id);
                });
            })->orderByRaw('FIELD(status_menu, "PENDING","DRAFT","APPROVED")')->get();
        }

        if (Auth::user()->is_restaurant) {
            return redirect(route('menu.edit', $this->getFirstMenuFromRestaurant()));
        }

        return view('admin.menu.index')
            ->with(compact('menu'));

    }


    public function create()
    {

        $menu = new Menu;
        $companies = Company::all();
        $restaurants = Restaurant::all();

        return view('admin.menu.create')->with([
                'menu' => $menu,
                'companies' => $companies,
                'restaurants' => $restaurants,
            ]
        );

    }


    public function store(Request $request)
    {

        $this->validation($request);

        $fields = $request->all();

        // if menu is only updated set to DRAFT status
        if (!isset($fields['status_menu'])) {
            $fields['status_menu'] = 'DRAFT';
        }

        $menu = Menu::create($fields);

        return redirect()->route('menu.index', $menu)->with([
            'notification' => trans('messages.notification.menu_saved'),
            'type-notification' => 'success'
        ]);
    }


    public function show(Menu $menu)
    {

        return view('admin.menu.view')->with([
                'menu' => $menu,
            ]
        );

    }


    public function edit(Menu $menu)
    {

        if (Auth::user()->is_super) {
            $companies = Company::all();
            $restaurants = Restaurant::all();
        } else {
            $companies = Auth::user()->brand->first();
            $restaurants = Auth::user()->brand->first()->restaurants;
        }

        $dishesProducts = $menu->products()->where('type', 'Dish')->where('status_product', 'APPROVED')->orWhere('status_product', 'PENDING')->get();
        $drinksProducts = $menu->products()->where('type', 'Drink')->where('status_product', 'APPROVED')->orWhere('status_product', 'PENDING')->get();

        return view('admin.menu.edit')->with([
                'menu' => $menu,
                'companies' => $companies,
                'restaurants' => $restaurants,
                'dishesProducts' => $dishesProducts,
                'drinksProducts' => $drinksProducts,
            ]
        );

    }

    public function update(Request $request, Menu $menu)
    {

        $this->validation($request, $menu);

        $fields = $request->all();
        // if menu is only updated set to DRAFT status
        if (!isset($fields['status_menu'])) {
            $fields['status_menu'] = 'DRAFT';
        }
        $fields['status'] = $request->status ? true : false;

        $menu->update($fields);

        return redirect()->route('menu.index', $menu)->with([
            'notification' => trans('messages.notification.menu_saved'),
            'type-notification' => 'success'
        ]);

    }


    public function destroy(Menu $menu)
    {

        $menu->delete();

          return redirect()->route('menu.index')->with([
                'notification' => trans('messages.notification.menu_removed'),
                'type-notification' => 'warning'
              ]);

    }


    protected function getFirstMenuFromRestaurant()
    {

        $menu = Auth::user()->restaurant->first()->menu;

        return $menu;

    }


}
