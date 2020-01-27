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

          $this->saveTranslation($section, $fields);

          $html = view('admin.menu.parts.menu-dish')->with('section', $section)->render();

          return response()->json($html, 200);
    }


    public function setPosition(MenuSection $section, Request $request) {

        $section->update(['position' => $request->position]);

        return $section;


    }


}
