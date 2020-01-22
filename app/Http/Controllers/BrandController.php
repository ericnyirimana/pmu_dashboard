<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\User;
use App\Models\Media;

class BrandController extends Controller
{


      public function validation(Request $request, $brand = null) {

          $request->validate(
            [
              'media_id'  => (empty($brand)?'required':'').'',
              'name'  => 'required',
              'vat'   => 'required'
            ]
          );

      }



      public function index() {

          $brands = Brand::all();

          return view('admin.brands.index')
          ->with( compact('brands') );

      }


      public function create() {

            $brand = null;
            $users = User::all();
            $media = Media::all();

            return view('admin.brands.form')->with([
              'brand'   => $brand,
              'users'   => $users,
              'media'   => $media
            ]
            );

      }


      public function store(Request $request) {

            $this->validation($request);

            $fields = $request->all();

            Brand::create($fields);

            return redirect()->route('brands.index')->with([
                  'notification' => 'Brand saved with success!',
                  'type-notification' => 'success'
                ]);

      }

      public function show(Brand $brand) {

            $users = User::all();
            $media = Media::all();

            return view('admin.brands.view')->with([
              'brand'     => $brand,
              'users'     => $users,
              'media'     => $media
            ]
            );

      }


      public function edit(Brand $brand) {

            $users = User::all();
            $media = Media::all();

            return view('admin.brands.form')->with([
              'brand'   => $brand,
              'users'   => $users,
              'media'   => $media
            ]
            );

      }

      public function update(Request $request, Brand $brand) {

            $this->validation($request, $brand);

            $fields = $request->all();

            $fields['status'] = $request->status ? true : false;

            $brand->update($fields);

            return redirect()->route('brands.index')->with([
                  'notification' => 'Brand saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Brand $brand) {

            $brand->delete();

            return redirect()->route('brands.index')->with([
                  'notification' => 'Image removed with success!',
                  'type-notification' => 'warning'
                ]);

      }


}
