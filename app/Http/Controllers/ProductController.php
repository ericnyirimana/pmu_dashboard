<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductSection;
use App\Models\Brand;
use App\Models\Media;
use App\Traits\TranslationTrait;

class ProductController extends Controller
{

  use TranslationTrait;


  public function validation(Request $request, $media = null) {

      $request->validate(
        [
          'name'          => 'required',
          'restaurant_id' => 'required',
        ]
      );

  }


    public function index() {

        $products = Product::all();

        return view('admin.products.index')
        ->with( compact('products') );

    }


    public function create() {

          $product = new Product();
          $brands = Brand::all();
          $restaurants = Restaurant::all();

          return view('admin.products.create')->with([
            'product'       => $product,
            'brands'        => $brands,
            'restaurants'   => $restaurants
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

          $this->saveTranslation($product, $fields);

          if ($request->media) {
              $product->media()->sync( array_unique($request->media) );
          }

          return redirect()->route('products.index')->with([
                'notification' => 'Product saved with success!',
                'type-notification' => 'success'
              ]);

    }

    public function show(Product $product) {


          return view('admin.menu.view')->with([
            'product'     => $product,
          ]
          );

    }


    public function edit(Product $product) {

          return view('admin.products.edit')->with([
            'product'   => $product,

          ]
          );

    }

    public function update(Request $request, Product $product) {

          $this->validation($request, $product);

          $fields = $request->all();

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




}
