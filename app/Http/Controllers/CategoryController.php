<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Company;
use App\Models\Media;
use App\Traits\TranslationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{

      use TranslationTrait;


      public function __construct() {

        $this->authorizeResource(Category::class);

      }


      public function validation(Request $request, $category = null) {

          /*$validationRules = [
              'media_id'  => (empty($category)?'required':'').'',
              'type'   => 'required'
          ];
          if ($request->name) {
              $companies = Company::where('name', $request->name)->pluck('type');
              if ($companies) {
                Arr::add($validationRules, 'name', 'required|string|unique:categories,type,'.);
              }
          }*/
          $request->validate(
            [
              'media_id'  => (empty($category)?'required':'').'',
              'name'   => 'required|string',
              'type'   => 'required'
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

            return view('admin.categories.create')->with([
              'category'  => $category
            ]
            );

      }


      public function store(Request $request) {

            $this->validation($request);

            $fields = $request->all();

            $fields['hide'] = isset($fields['hide']) ? true : false;

            $category = Category::create($fields);

            $this->saveTranslation($category, $fields);

            return redirect()->route('categories.index')->with([
                  'notification' => trans('messages.notification.category_saved'),
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

            return view('admin.categories.edit')->with([
              'category'  => $category
            ]
            );

      }

      public function update(Request $request, Category $category) {

            $this->validation($request, $category);

            $fields = $request->all();

            $fields['hide'] = isset($fields['hide']) ? true : false;

            $this->saveTranslation($category, $fields);

            $category->update($fields);

            return redirect()->route('categories.index')->with([
                  'notification' => trans('messages.notification.category_saved'),
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Category $category) {

            $category->delete();

            return redirect()->route('categories.index')->with([
                  'notification' => trans('messages.notification.category_removed'),
                  'type-notification' => 'warning'
                ]);

      }

}
