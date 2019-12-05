<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{



      public function validation(Request $request, $brand = null) {

          $request->validate(
            [
              'image'  => (empty($brand)?'required|':'').'image|mimes:jpeg,bmp,png',
              'category_type_id'   => 'required'
            ]
          );

      }



      public function index() {

          $categories = Category::all();

          return view('admin.categories.index')
          ->with( compact('categories') );

      }


      public function create() {

            $brand = null;
            $operators = Operator::all();

            return view('admin.categories.form')->with([
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

            Category::create($fields);

            return redirect()->route('categories.index')->with([
                  'notification' => 'Category saved with success!',
                  'type-notification' => 'success'
                ]);

      }

      public function show(Category $brand) {

            $operators = Operator::all();

            return view('admin.categories.view')->with([
              'brand'     => $brand,
              'operators' => $operators
            ]
            );

      }


      public function edit(Category $brand) {

            $operators = Operator::all();

            return view('admin.categories.form')->with([
              'brand'     => $brand,
              'operators' => $operators
            ]
            );

      }

      public function update(Request $request, Category $brand) {

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

            return redirect()->route('categories.index')->with([
                  'notification' => 'Category saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Category $brand) {

            $this->removeImage($brand->image);
            $brand->delete();

            return redirect()->route('categories.index')->with([
                  'notification' => 'Image removed with success!',
                  'type-notification' => 'warning'
                ]);

      }

}
