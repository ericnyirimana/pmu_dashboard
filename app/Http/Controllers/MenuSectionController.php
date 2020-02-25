<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuSection;
use App\Models\ProductSection;
use App\Models\Product;

use App\Traits\TranslationTrait;

use Auth;

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

          if (MenuSection::where('menu_id', $menu->id)->whereHas('translate', function($q) use($request) {
              $q->where('name', $request->name);
          })->exists()) {
            return response()->json('Section already exists', 401);
          }

          $section = $menu->sections()->create($fields);

          if (!$section) {
              return response()->json('Section not found', 404);
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

          $section = $this->validationCanAddSection($request->section_id);


          if($section) {

              $views = $this->attachProducts($request->add_products, $section);

              if ($views) {

                  return response()->json(['id' => $request->section_id, 'views' => $views], 200);
              }

          }

          return response()->json(['error' => 'You have no permission.'], 200);

    }

    /**
    * Validation Section if user can edit the menu related
    *
    * @param integer $section_id
    *
    * @return Section
    */
    protected function validationCanAddSection($section_id) {

            $section = MenuSection::find($section_id);

            if ( $section->menu->userCanEdit( Auth::user() )) {

                return $section;
            }

    }

    /**
    * Attach products to section if have permission
    *
    * @param array $products_ids
    * @param MenuSection $section
    *
    * @return array
    */
    protected function attachProducts(array $products_ids, MenuSection $section) {

          $views = array();
          foreach($products_ids as $id) {

              $product = Product::find($id);

              // check if belongs to same restaurant
              if ( $product->restaurant->id == $section->menu->restaurant->id ) {

                  if (!$section->products()->find($id)) {

                      $product->menu_section_id = $section->id;
                      $product->save();

                      $html = view('admin.menu.parts.menu-dish-item')->with(['section' => $section, 'product' => $product ])->render();

                      array_push($views, $html);

                  }

              }
          }

          return $views;

    }


}
