<?php

namespace App\Http\Controllers;

use App\Models\Showcase;
use Illuminate\Http\Request;
use App\Traits\TranslationTrait;

class ShowcaseController extends Controller
{

    use TranslationTrait;

//    public function __construct() {
//
//        $this->authorizeResource(Showcase::class);
//
//    }

    public function validation(Request $request) {

        $request->validate(
          [
            'name',
            'title'  => 'required',
            'type'  => 'required',
            'items' => ''
          ]
        );

    }


    public function index() {

        $showcases = Showcase::all();

        return view('admin.showcases.index')
            ->with(compact('showcases'));

    }


    public function create() {

        $showcases = new Showcase();

        $categories = Showcase::where('type', 'categories')->with('translate')->get()->pluck('translate.name');
        $restaurants = Showcase::where('type', 'restaurants')->with('translate')->get()->pluck('translate.name');
        $timeslots = Showcase::where('type', 'timeslots')->with('translate')->get()->pluck('translate.name');

        return view('admin.showcases.create')->with([
                'showcases'   => $showcases,
                'categories' => $categories,
                'restaurants' => $restaurants,
                'timeslots' => $timeslots
            ]
        );

    }


    public function store(Request $request)
    {

        $this->validation($request);

        $fields = $request->all();

        $showcases = Showcase::create($fields);

        $this->saveTranslation($showcases, $fields);

        return redirect()->route('showcases.index', $showcases)->with([
            'notification' => 'Nuovo vetrina salvata con successo!',
            'type-notification' => 'success'
        ]);

    }


    public function show(Showcase $showcases) {

          // dd($showcases->pickups);

          return view('admin.showcases.view')->with([
              'showcases'  => $showcases
              ]
          );

    }


    public function edit(Showcase $showcases) {

        $categories = Showcase::where('type', 'categories')->with('translate')->get()->pluck('translate.name');
        $restaurants = Showcase::where('type', 'restaurants')->with('translate')->get()->pluck('translate.name');
        $timeslots = Showcase::where('type', 'timeslots')->with('translate')->get()->pluck('translate.name');

        return view('admin.showcases.edit')->with([
                'showcases'  => $showcases,
                'categories' => $categories,
                'restaurants' => $restaurants,
                'timeslots' => $timeslots
            ]
        );

    }


    public function update(Request $request, Showcase $showcases) {

        $this->validation($request, $showcases);

        $fields = $request->all();

        $showcases->update($fields);

        $this->saveTranslation($showcases, $fields);

        return redirect()->route('showcases.index')->with([
            'notification' => 'Vetrina salvata con successo!',
            'type-notification' => 'success'
        ]);

    }

    public function destroy(Showcase $showcases) {

        $showcases->delete();

        return redirect()->route('showcases.index')->with([
            'notification' => 'Vetrina rimossa con successo!',
            'type-notification' => 'warning'
        ]);

    }


}
