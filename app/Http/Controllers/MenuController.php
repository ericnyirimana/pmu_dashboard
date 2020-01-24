<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Brand;
use App\Models\Media;
use App\Models\Category;

class MenuController extends Controller
{



    public function validation(Request $request, $media = null) {

        $request->validate(
          [
            'name'  => 'required',
            'restaurant_id',
          ]
        );

    }


    public function index() {

        $menu = Menu::all();

        return view('admin.menu.index')
        ->with( compact('menu') );

    }


    public function create() {

          $menu = null;
          $brands = Brand::all();
          $media = Media::all();


          return view('admin.menu.create')->with([
            'menu'   => $menu,
            'brands'   => $brands,

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

          $brands = Brand::all();

          return view('admin.menu.edit')->with([
            'menu'    => $menu,
            'brands'  => $brands
          ]
          );

    }

    public function update(Request $request, Menu $menu) {

          $this->validation($request, $menu);

          $fields = $request->all();

          $fields['status'] = $request->status ? true : false;

          $menu->update($fields);

          return redirect()->route('menu.index')->with([
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


}
