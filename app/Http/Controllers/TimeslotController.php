<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Timeslot;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class TimeslotController extends Controller
{

    public function __construct()
    {

        $this->authorizeResource(Timeslot::class);
    }

    public function validation(Request $request) {

        $validation = [
            'hour_ini' => 'required',
            'hour_end' => 'required'
        ];

        $request->validate(
            $validation
        );

    }

    public function index()
    {
        $timeslots = new Collection();
        if (Auth::user()->is_restaurant && Auth::user()->restaurant->first()) {
            $timeslots = Timeslot::where('restaurant_id', Auth::user()->restaurant->first()->id)->get();
        } else {
            $timeslots = Timeslot::whereIn('restaurant_id', Auth::user()->brand->first()->restaurants->pluck('id'))
                ->get();
        }

        return view('admin.timeslots.index')
            ->with(compact('timeslots'));
    }

    public function edit(Timeslot $timeslot)
    {
        return view('admin.timeslots.edit')->with([
                'timeslot' => $timeslot
            ]
        );
    }

    public function update(Request $request, Timeslot $timeslot) {

        $this->validation($request, $timeslot);

        $fields = $request->all();

        $timeslot->update($fields);

        return redirect()->route('timeslots.index')->with([
            'notification' => trans('messages.notification.hour_saved'),
            'type-notification' => 'success'
        ]);

    }

    public function destroy(Timeslot $timeslot) {

        $timeslot->delete();

        return redirect()->route('timeslots.index')->with([
            'notification' => trans('messages.notification.hour_removed'),
            'type-notification' => 'warning'
        ]);

    }

    public function data(Restaurant $restaurant)
    {

        if ($restaurant) {

            return response()->json($restaurant->timeslots, 200);
        }

        return response()->json(['error' => 'No restaurant selected'], 404);

    }

}
