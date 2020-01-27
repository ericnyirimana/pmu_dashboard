<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuSection;
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


    public function remove(Request $request) {

        $section = MenuSection::find($request->id);

        $section->delete();

        return response()->json(['id'=>$request->id], 200);


    }




    public function setPosition(MenuSection $section, Request $request) {

        $section->update(['position' => $request->position]);

        return $section;


    }


}
