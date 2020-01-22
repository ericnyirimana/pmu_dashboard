<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Media;

class ProductController extends Controller
{


  public function index() {

      $product = Product::all();

      return view('admin.menu.index')
      ->with( compact('menu') );

  }


  public function create() {

        $product = null;
        $brands = Brand::all();
        $restaurants = Restaurant::all();
        $media = Media::all();

        return view('admin.products.create')->with([
          'product'       => $product,
          'brands'        => $brands,
          'restaurants'   => $restaurants,
          'media'         => $media
        ]
        );

  }


  public function store(Request $request) {

        $this->validation($request);

        $fields = $request->all();

        Product::create($fields);

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

        return view('admin.menu.edit')->with([
          'product'   => $product,

        ]
        );

  }

  public function update(Request $request, Product $product) {

        $this->validation($request, $product);

        $fields = $request->all();

        $product->update($fields);

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

}
