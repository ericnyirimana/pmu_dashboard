<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Product;
use App\Models\ProductSection;
use App\Models\Brand;
use App\Models\Category;
use App\Traits\TranslationTrait;

use App\Rules\SameBrandProduct;

use Auth;

class ProductController extends Controller
{

    use TranslationTrait;



    public function __construct() {

      $this->authorizeResource(Product::class);

    }


    public function validation(Request $request, $media = null) {

        $request->validate(
          [
            'name'          => 'required',
            'brand_id'      => new SameBrandProduct(),
          ]
        );

    }



    public function index() {

        if (Auth::user()->is_super) {
          $products = Product::all();

        } else {

          $products = Auth::user()->brand->products;
        }


        return view('admin.products.index')
        ->with( compact('products') );

    }


    public function create() {

          $route = \Request::route()->getName();
          $arrRoute = explode('.', $route);

          $product = new Product();
          $product->type = ucfirst(end($arrRoute));

          if (Auth::user()->is_super) {
            $brands = Brand::all();

          } else {
            $brands = Auth::user()->brand;
          }

          $foods = Category::where('type', 'Food')->with('translation')->get()->pluck('translation.name');
          $allergens = Category::where('type', 'Allergen')->with('translation')->get()->pluck('translation.name');
          $dietaries = Category::where('type', 'Dietary')->with('translation')->get()->pluck('translation.name');



          return view('admin.products.create')->with([
            'product'       => $product,
            'brands'        => $brands,
            'foods'      => $foods,
            'allergens'  => $allergens,
            'dietaries'  => $dietaries
            ]
          );

    }


    public function store(Request $request) {

          $inputs = $request->all();

          $this->validation($request);

          $fields = $request->all();

          $fields['type'] = $request->type ?? 'Dish';
          $fields['status'] = $request->status ?? false;

          $product = Product::create($fields);

          $product->translation->update($fields);

          $this->saveCategories($product, $fields);

          if ($request->media) {
              $product->media()->sync( array_unique($request->media) );
          }

          return redirect()->route('products.index')->with([
                'notification' => 'Product saved with success!',
                'type-notification' => 'success'
              ]);

    }

    public function show(Product $product) {

          return view('admin.products.view')->with([
            'product'     => $product,
          ]
          );

    }


    public function edit(Product $product) {

      if (Auth::user()->is_super) {
        $brands = Brand::all();

      } else {
        $brands = Auth::user()->brand;
      }

      $foods = Category::where('type', 'Food')->with('translation')->get()->pluck('translation.name');
      $allergens = Category::where('type', 'Allergen')->with('translation')->get()->pluck('translation.name');
      $dietaries = Category::where('type', 'Dietary')->with('translation')->get()->pluck('translation.name');


      return view('admin.products.edit')->with([
        'product'     => $product,
        'brands'      => $brands,
        'foods'      => $foods,
        'allergens'  => $allergens,
        'dietaries'  => $dietaries
      ]
      );

    }

    public function update(Request $request, Product $product) {

          $this->validation($request, $product);

          $fields = $request->all();

          $this->saveCategories($product, $fields);

          $product->update($fields);

          $product->translation->update($fields);



          if ($request->media) {
              $product->media()->sync( array_unique($request->media) );
          }

          return redirect()->route('products.index')->with([
                'notification' => 'Product saved with success!',
                'type-notification' => 'success'
              ]);

    }


    public function destroy(Product $product) {

          $product->delete();

          return redirect()->route('products.index')->with([
                'notification' => 'Image removed with success!',
                'type-notification' => 'warning'
              ]);

    }


    public function ajaxDestroy(Request $request) {

        $productSection = ProductSection::where('product_id', $request->product_id)->where('menu_section_id', $request->section_id)->first();
        $productSection->delete();

        return response()->json(['id' => $request->product_id], 200);

    }



      public function setPosition(Product $product, Request $request) {

          $product->update(['position' => $request->position]);

          return $product;

      }


      public function saveCategories(Product $product, array $fields) {

            $list = array();

            $categoriesList = $this->getCategoriesId($fields['foods']);
            $allergensList = $this->getCategoriesId($fields['allergens']);
            $dietaryList = $this->getCategoriesId($fields['dietaries']);

            $categories = array_merge($categoriesList, $allergensList, $dietaryList);

            $product->categories()->sync($categories);

      }



      public function getCategoriesId($array) {

        $list = array();

        foreach($array as $key=>$category) {

              $categoryModel = Category::whereHas('translation', function($q) use ($category) {
                  $q->where('name', $category);
              })->first();

              if($categoryModel) {
                  array_push($list, $categoryModel->id);
              }

        }

        return $list;

      }

}
