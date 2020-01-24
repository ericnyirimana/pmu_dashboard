<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Media;

class ProductController extends Controller
{


  public function index() {

      $product = Product::all();

      return view('admin.menu.index')
      ->with( compact('menu') );

  }


  public function create() {

        $product = new Product();
        $brands = Brand::all();
        $restaurants = Restaurant::all();

        $categories = $this->getCategoriesByType();

        return view('admin.products.create')->with([
          'product'       => $product,
          'brands'        => $brands,
          'restaurants'   => $restaurants,
          'categories'   => $categories
          ]
        );

  }


  public function store(Request $request) {

        $inputs = $request->all();

        dd($inputs);


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


  public function getCategoriesByType() {

      $categories = Category::all();

      $list['foods'] = array();
      $list['dietary'] = array();
      $list['allergens'] = array();

      foreach($categories as $cat) {
          if($cat->type->name == 'Food Category') {
              array_push($list['foods'], $cat->translation->name);
          }
          if($cat->type->name == 'Dietary') {
              array_push($list['dietary'], $cat->translation->name);
          }
          if($cat->type->name == 'Allergens') {
              array_push($list['allergens'], $cat->translation->name);
          }
      }

      return $list;

  }

}
