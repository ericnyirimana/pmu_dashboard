<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Media;

class ProductController extends Controller
{


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

          $product = Product::create($fields);

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


    public function ajaxDestroy(Product $product) {

          $product->delete();

          return true;

    }



      public function setPosition(Product $product, Request $request) {

          $product->update(['position' => $request->position]);

          return $product;


      }




}
