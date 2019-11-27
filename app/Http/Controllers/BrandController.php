<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\Operator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Image;

class BrandController extends Controller
{

      protected $brand_path = '/app/public/brands/';



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

          $brands = Brand::all();

          return view('admin.brands.index')
          ->with( compact('brands') );

      }


      public function create() {

            $brand = null;
            $operators = Operator::all();

            return view('admin.brands.form')->with([
              'brand'     => $brand,
              'operators' => $operators
            ]
            );

      }


      public function store(Request $request) {

            $this->validation($request);

            $fields = $request->all();

            $image = $request->file('image');

            $fields['image'] = $this->saveImage($image);

            $fields['status'] = $request->status ? true : false;

            Brand::create($fields);

            return redirect()->route('brands.index')->with([
                  'notification' => 'Brand saved with success!',
                  'type-notification' => 'success'
                ]);

      }

      public function show(Brand $brand) {

            $operators = Operator::all();

            return view('admin.brands.view')->with([
              'brand'     => $brand,
              'operators' => $operators
            ]
            );

      }


      public function edit(Brand $brand) {

            $operators = Operator::all();

            return view('admin.brands.form')->with([
              'brand'     => $brand,
              'operators' => $operators
            ]
            );

      }

      public function update(Request $request, Brand $brand) {

            $this->validation($request, $brand);

            $fields = $request->all();

            if ($request->image) {

              $image = $request->file('image');

              // remove old image
              $this->removeImage($brand->image);

              $fields['image'] = $this->saveImage($image);

            }

            $fields['status'] = $request->status ? true : false;

            $brand->update($fields);

            return redirect()->route('brands.index')->with([
                  'notification' => 'Brand saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Brand $brand) {

            $this->removeImage($brand->image);
            $brand->delete();

            return redirect()->route('brands.index')->with([
                  'notification' => 'Image removed with success!',
                  'type-notification' => 'warning'
                ]);

      }


      protected function saveImage($image) {

            $path = $image->store('public/brands');
            $name = str_replace('public/brands/', '', $path);

            $this->resizeImage($name);

            return $name;
      }



      protected function resizeImage($image) {


            $img = Image::make( storage_path() . $this->brand_path . $image);

            // save thumbnail
            $img->fit(100, 100)->save( storage_path() . $this->brand_path . 'thumbnail/' . $image);

            // save medium
            $img->resize(1000, 1000, function ($constraint) {
              $constraint->aspectRatio();
            })->save( storage_path() . $this->brand_path . 'medium/' . $image);



      }

      protected function removeImage($image) {

            Storage::disk('public')->delete('brands/'.$image);
            Storage::disk('public')->delete('brands/thumbnail/'.$image);
            Storage::disk('public')->delete('brands/medium/'.$image);
            Storage::disk('public')->delete('brands/large/'.$image);

      }

}
