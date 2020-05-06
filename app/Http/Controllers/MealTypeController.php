<?php

namespace App\Http\Controllers;

use App\Models\Mealtype;
use Illuminate\Http\Request;
use App\Traits\TranslationTrait;

class MealTypeController extends Controller
{

    use TranslationTrait;

    public function __construct() {

        $this->authorizeResource(Mealtype::class);

    }

    public function validation(Request $request) {

        $validation = [
            'name',
            'hour_ini' => 'required',
            'hour_end' => 'required'
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

        $this->saveTranslation($mealtype, $fields);

        return redirect()->route('mealtypes.index', $mealtype)->with([
            'notification' => trans('messages.notification.hour_saved'),
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

        $this->saveTranslation($mealtype, $fields);

        return redirect()->route('mealtypes.index')->with([
            'notification' => trans('messages.notification.hour_saved'),
            'type-notification' => 'success'
        ]);

    }

    public function destroy(Mealtype $mealtype) {

        $mealtype->delete();

        return redirect()->route('mealtypes.index')->with([
            'notification' => trans('messages.notification.hour_removed'),
            'type-notification' => 'warning'
        ]);

    }

}
