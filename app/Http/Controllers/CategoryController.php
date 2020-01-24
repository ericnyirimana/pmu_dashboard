<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryType;
use App\Models\Category;
use App\Models\Media;
use App\Traits\TranslationTrait;


class CategoryController extends Controller
{

      use TranslationTrait;


      public function validation(Request $request, $category = null) {

          $request->validate(
            [
              'media_id'  => (empty($category)?'required':'').'',
              'name'   => 'required',
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

            $category = new Category();
            $types = CategoryType::all();

            return view('admin.categories.create')->with([
              'category'  => $category,
              'types'     => $types
            ]
            );

      }


      public function store(Request $request) {

            $this->validation($request);

            $locale = \App::getLocale();
            $fields = $request->all();

            $category = Category::create($fields);

            $this->saveTranslation($category, $fields);

            return redirect()->route('categories.index')->with([
                  'notification' => 'Category saved with success!',
                  'type-notification' => 'success'
                ]);

      }



      public function show(Category $category) {

            // get only media who doesn`t bellongs to restaurant
            $media = Media::whereNull('brand_id')->get();

            return view('admin.categories.view')->with([
              'category'  => $category,
              'media'     => $media
            ]
            );

      }


      public function edit(Category $category) {

            $types = CategoryType::all();

            return view('admin.categories.edit')->with([
              'category'  => $category,
              'types'     => $types
            ]
            );

      }

      public function update(Request $request, Category $category) {

            $this->validation($request, $category);

            $fields = $request->all();

            $this->saveTranslation($category, $fields);

            $category->update($fields);

            return redirect()->route('categories.index')->with([
                  'notification' => 'Category saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Category $category) {

            $this->removeImage($category->image);
            $category->delete();

            return redirect()->route('categories.index')->with([
                  'notification' => 'Image removed with success!',
                  'type-notification' => 'warning'
                ]);

      }

}
