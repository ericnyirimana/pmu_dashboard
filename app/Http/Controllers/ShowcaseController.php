<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mealtype;
use App\Models\Restaurant;
use App\Models\Showcase;
use Illuminate\Http\Request;
use App\Traits\TranslationTrait;

class ShowcaseController extends Controller
{

    use TranslationTrait;

    public function __construct() {

        $this->authorizeResource(Showcase::class);

    }

    public function validation(Request $request) {

        $request->validate(
          [
            'name',
            'title'  => 'required',
            'type'  => 'required',
            'categories',
            'restaurants',
            'mealtypes'
          ]
        );

    }


    public function index() {

        $showcase = Showcase::all();

        return view('admin.showcases.index')
            ->with(compact('showcase'));

    }


    public function create() {

        $showcase = new Showcase();

        $categories = Category::where('type', 'Food')->with('translate')->get()->pluck('translate.name');
        //$restaurants = Restaurant::all()->pluck('name');
        //$mealtypes = Mealtype::all()->pluck('name');

        return view('admin.showcases.create')->with([
                'showcase'   => $showcase,
                'categories' => $categories,
                //'restaurants' => $restaurants,
                //'mealtypes' => $mealtypes
            ]
        );

    }


    public function store(Request $request)
    {

        $this->validation($request);

        $fields = $request->all();

        $showcase = Showcase::create($fields);

        $this->saveTranslation($showcase, $fields);
        $this->saveCategories($showcase, $fields);
        //$this->saveRestaurants($showcase, $fields);
        //$this->saveMealtypes($showcase, $fields);

        return redirect()->route('showcases.index', $showcase)->with([
            'notification' => 'Nuovo vetrina salvata con successo!',
            'type-notification' => 'success'
        ]);

    }


    public function show(Showcase $showcase) {

          // dd($showcase->pickups);

          return view('admin.showcases.view')->with([
              'showcase'  => $showcase
              ]
          );

    }


    public function edit(Showcase $showcase) {

        $categories = Category::where('type', 'Food')->with('translate')->get()->pluck('translate.name');
        //$restaurants = Restaurant::all()->pluck('name');
        //$mealtypes = Mealtype::all()->pluck('name');

        return view('admin.showcases.edit')->with([
                'showcase'  => $showcase,
                'categories' => $categories,
                //'restaurants' => $restaurants,
                //'mealtypes' => $mealtypes
            ]
        );

    }


    public function update(Request $request, Showcase $showcase) {

        $this->validation($request, $showcase);

        $fields = $request->all();

        $showcase->update($fields);

        $this->saveTranslation($showcase, $fields);
        $this->saveCategories($showcase, $fields);
        //$this->saveRestaurants($showcase, $fields);
        //$this->saveMealtypes($showcase, $fields);

        return redirect()->route('showcases.index')->with([
            'notification' => 'Vetrina salvata con successo!',
            'type-notification' => 'success'
        ]);

    }

    public function destroy(Showcase $showcase) {

        $showcase->delete();

        return redirect()->route('showcases.index')->with([
            'notification' => 'Vetrina rimossa con successo!',
            'type-notification' => 'warning'
        ]);

    }


    public function saveCategories(Showcase $showcase, array $fields) {

        $categoriesList = $this->getCategoriesId(@$fields['categories']);

        $categories = array_merge($categoriesList);

        $showcase->categories()->sync($categories);

    }


//    public function saveRestaurants(Showcase $showcase, array $fields) {
//
//        $restaurantsList = $this->getRestaurantsId(@$fields['restaurants']);
//
//        $restaurants = array_merge($restaurantsList);
//
//        $showcase->restaurants()->sync($restaurants);
//
//    }
//
//
//    public function saveMealtypes(Showcase $showcase, array $fields) {
//
//        $mealtypesList = $this->getMealtypesId(@$fields['mealtypes']);
//
//        $mealtypes = array_merge($mealtypesList);
//
//        $showcase->mealtypes()->sync($mealtypes);
//
//    }

    public function getCategoriesId($array) {

        $list = array();

        if (empty($array)) return array();

        foreach($array as $key=>$category) {

            $categoryModel = Category::whereHas('translate', function($q) use ($category) {
                $q->where('name', $category);
            })->first();

            if($categoryModel) {
                array_push($list, $categoryModel->id);
            }

        }

        return $list;

    }

//    public function getRestaurantsId($array) {
//
//        $list = array();
//
//        if (empty($array)) return array();
//
//        foreach($array as $key=>$restaurant) {
//
//            $restaurantModel = Restaurant::where('name', $restaurant)->first();
//
//            if($restaurantModel) {
//                array_push($list, $restaurantModel->id);
//            }
//
//        }
//
//        return $list;
//
//    }
//
//    public function getMealtypesId($array) {
//
//        $list = array();
//
//        if (empty($array)) return array();
//
//        foreach($array as $key=>$mealtype) {
//
//            $mealtypeModel = Mealtype::whereHas('translate', function($q) use ($mealtype) {
//                $q->where('name', $mealtype);
//            })->first();
//
//            if($mealtypeModel) {
//                array_push($list, $mealtypeModel->id);
//            }
//
//        }
//
//        return $list;
//
//    }


}
