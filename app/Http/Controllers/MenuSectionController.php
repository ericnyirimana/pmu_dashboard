<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuSection;
use App\Models\ProductSection;
use App\Models\Product;

use App\Traits\TranslationTrait;

class MenuSectionController extends Controller
{


    use TranslationTrait;


    public function validation(Request $request) {

        $request->validate(
          [
            'name'   => 'required',
            'type'   => 'required'
          ]
        );

    }



    public function save(Menu $menu, Request $request) {

          $this->validation($request);

          $fields = $request->all();

          $section = $menu->sections()->create($fields);

          if (!$section) {
              return response()->json('error: Section not found', 404);
          }

          $this->saveTranslation($section, $fields);

          $html = view('admin.menu.parts.menu-dish')->with('section', $section)->render();

          return response()->json($html, 200);
    }



    public function update(Menu $menu, Request $request) {

          $fields = $request->all();

          if ($request->id) {

              $section = MenuSection::find($request->id);

          }
          if (!$section) {
              return response()->json('error: Section not found', 404);
          }

          $section->update($fields);
          $this->saveTranslation($section, $fields);

          return response()->json($section, 200);
    }



    public function destroy(Request $request) {

        $section = MenuSection::find($request->id);

        $section->delete();

        return response()->json(['id'=>$request->id], 200);


    }




    public function setPosition(MenuSection $section, Request $request) {

        $section->update(['position' => $request->position]);

        return response()->json(['id'=>$section->id], 200);


    }



    public function addProduct(Request $request) {

          $products_ids = $request->add_products;
          $section_id = $request->section_id;
          $section = MenuSection::find($section_id);
          $views = array();

          if($products_ids) {
              foreach ($products_ids as $product_id) {

                  $productSection = ProductSection::where('menu_section_id', $section_id)->where('product_id', $product_id)->exists();

                  if (!$productSection) {

                    ProductSection::create(['menu_section_id' => $section_id, 'product_id' => $product_id]);

                    $product = Product::find($product_id);

                    $html = view('admin.menu.parts.menu-dish-item')->with(['section' => $section, 'product' => $product ])->render();

                    array_push($views, $html);
                  }

              }

              return response()->json(['id' => $request->section_id, 'views' => $views], 200);
            }

    }


}
