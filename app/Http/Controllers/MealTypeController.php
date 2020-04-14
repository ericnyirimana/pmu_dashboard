<?php

namespace App\Http\Controllers;

use App\Models\Mealtype;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{

    public function __construct() {

        $this->authorizeResource(Mealtype::class);

    }

    public function validation(Request $request) {

        $validation = [
            'id',
            'range_clock'     => 'required'
        ];

        $request->validate(
            $validation
        );

    }

    public function index()
    {

        $mealtype = Mealtype::all();

        return view('admin.mealtypes.index')
            ->with(compact('mealtype'));

    }

    public function create() {

        $mealtype = new Mealtype();

        return view('admin.mealtypes.create')->with([
                'mealtype'   => $mealtype
            ]
        );

    }

    public function store(Request $request)
    {

        $this->validation($request);

        $fields = $request->all();

        $mealtype = Mealtype::create($fields);

        return redirect()->route('mealtypes.edit', $mealtype)->with([
            'notification' => 'Nuovo orario salvato con successo!',
            'type-notification' => 'success'
        ]);

    }

    public function show(Mealtype $mealtype) {

        return view('admin.mealtypes.view')->with([
                'mealtype'  => $mealtype
            ]
        );

    }

    public function edit(Mealtype $mealtype) {

        return view('admin.mealtypes.edit')->with([
                'mealtype'  => $mealtype
            ]
        );

    }

    public function update(Request $request, Mealtype $mealtype) {

        $this->validation($request, $mealtype);

        $fields = $request->all();

        $mealtype->update($fields);

        return redirect()->route('mealtypes.index')->with([
            'notification' => 'Orario salvato con successo!',
            'type-notification' => 'success'
        ]);

    }

    public function destroy(Mealtype $mealtype) {

        $mealtype->delete();

        return redirect()->route('mealtypes.index')->with([
            'notification' => 'Orario rimosso con successo!',
            'type-notification' => 'warning'
        ]);

    }

}
