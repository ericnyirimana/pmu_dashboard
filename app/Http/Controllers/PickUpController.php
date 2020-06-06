<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


use App\Models\Pickup;
use App\Models\Media;
use App\Traits\TranslationTrait;
use Carbon\Carbon;

use Auth;

class PickupController extends Controller
{

    use TranslationTrait;


    public function __construct()
    {

        $this->authorizeResource(Pickup::class);

    }


    public function validation(Request $request, $pickup = null)
    {
        $validation = [
            'name' => 'required'
        ];
        if ($pickup) {
            if ($pickup->orders->count() > 0 && $pickup->is_active_today) {

            } else {
                $validation += [
                    'price' => ['required', 'integer'],
                    'products' => ['required', 'array'],
                    'quantity_offer' => ['required', 'integer']
                ];
            }
        } else {
            $validation = [
                'type_pickup' => 'required',
                'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
                'restaurant_id' => ['required_if:role,ADMIN,OWNER', new \App\Rules\RestaurantBelongsToCompany],
                'date' => ['required'],
                'timeslot_id' => ['required', new \App\Rules\TimeslotBelongsToRestaurant]

            ];
        }

        $request->validate(
            $validation
        );

    }


    public function index()
    {

        $pickups = $this->retrieveOfferByUserRole();

        return view('admin.pickups.index')
            ->with(compact('pickups'));

    }


    public function create()
    {

        $pickup = new Pickup;

        $media = Media::whereNull('brand_id')->orWhere('brand_id', $pickup->id)->get();

        return view('admin.pickups.create')->with([
                'pickup' => $pickup,
                'media' => $media,
            ]
        );

    }


    public function store(Request $request)
    {

        $this->setDefaultCompanyForOwnerOrRestaurateur($request);
        $this->validation($request);

        $fields = $request->all();

        $dates = explode('|', $fields['date']);
        $fields['date_ini'] = Carbon::parse($dates[0]);
        $fields['date_end'] = Carbon::parse($dates[1]);

        $pickup = Pickup::create($fields);
        if ($pickup->type_pickup == 'offer') {
            $pickup->offer()->create(['type_offer' => 'single', 'quantity_offer' => '10', 'price' => 7]);
        } else {
            $pickup->subscription()->create(['type_offer' => 'single', 'quantity_offer' => '10', 'price' => 7, 'validate_days' => 5]);
        }
        $this->saveTranslation($pickup, $fields);

        if ($request->media) {
            $pickup->media()->sync(array_unique($request->media));
        }

        return redirect()->route('pickups.edit', $pickup)->with([
            'notification' => trans('messages.notification.pickup_saved'),
            'type-notification' => 'success'
        ]);

    }

    public function show(Pickup $pickup)
    {

        return view('admin.pickups.view')->with([
                'pickup' => $pickup,
            ]
        );

    }


    public function edit(Pickup $pickup)
    {

        $menu = $pickup->restaurant->menu()->where('status_menu', 'APPROVED')->first();
        $media = Media::whereNull('brand_id')->orWhere('brand_id', $pickup->id)->get();

        return view('admin.pickups.edit')->with([
                'pickup' => $pickup,
                'menu' => $menu,
                'media' => $media,
            ]
        );
    }


    public function update(Request $request, Pickup $pickup)
    {
        $this->setDefaultCompanyForOwnerOrRestaurateur($request);
        $this->validation($request, $pickup);

        $fields = $request->all();

        if (isset($fields['date'])) {
            $dates = explode('|', $fields['date']);

            $fields['date_ini'] = Carbon::parse($dates[0]);
            $fields['date_end'] = Carbon::parse($dates[1]);
        }

        if ($fields['quantity_offer'] < $pickup->quantity_offer) {
            return redirect()->route('pickups.edit', $pickup)->with([
                'notification' => trans('messages.notification.pickup_quantity_wrong'),
                'type-notification' => 'danger'
            ]);
        }
        foreach ($fields['products'] as $k => $v) {

            if ($fields['quantity_offer'] > $fields['quantity'][$k]) {
                return redirect()->route('pickups.edit', $pickup)->with([
                    'notification' => trans('messages.notification.pickup_quantity_wrong'),
                    'type-notification' => 'danger'
                ]);
            }
            $products[$v] = ['quantity_offer' => $fields['quantity'][$k]];
        }

        $pickup->update($fields);

        if ($pickup->type_pickup == 'offer') {
            $pickup->offer->update($fields);
        } else {
            $pickup->subscription->update($fields);
        }

        $this->saveTranslation($pickup, $fields);
        $pickup->products()->sync($products);

        if ($request->media) {
            $pickup->media()->sync(array_unique($request->media));
        }

        return redirect()->route('pickups.index')->with([
            'notification' => trans('messages.notification.pickup_saved'),
            'type-notification' => 'success'
        ]);

    }


    public function destroy(Pickup $pickup)
    {


        $pickup->delete();

        return redirect()->route('pickups.index')->with([
            'notification' => trans('messages.notification.pickup_removed'),
            'type-notification' => 'warning'
        ]);

    }

    public function replicate(Pickup $pickup) {

        $newPickup = $pickup->replicate();

        $newPickup->push();

        //HasOne Relations
        $newPickup->translate()->create(['name' => 'COPY OF ' . $pickup->name, 'description' => $pickup->description,
            'code' =>
            \App::getLocale()]);

        if ($pickup->type_pickup == 'offer') {
            $newPickup->offer()->create(['type_offer' => $pickup->offer->type_offer, 'quantity_offer' =>
                $pickup->offer->quantity_offer, 'price' => $pickup->offer->price]);
        } else {
            $newPickup->subscription()->create(['type_offer' => $pickup->offer->type_offer, 'quantity_offer' =>
                $pickup->offer->quantity_offer, 'price' => $pickup->offer->price, 'validate_days' =>
                $pickup->offer->validate_days]);
        }

        $newPickup->save();

        $mediaID = $pickup->media->pluck('id');
        $newPickup->media()->sync($mediaID);

        $productsID = $pickup->products->pluck('id');
        $newPickup->products()->sync($productsID);

        return redirect()->route('pickups.edit', $newPickup)->with([
            'notification' => trans('messages.notification.pickup_copied'),
            'type-notification' => 'success'
        ]);
    }

    public function calendar()
    {
        try {
            $pickups = $this->retrieveOfferByUserRole();
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }


        return view('admin.pickups.calendar')
            ->with(compact('pickups'));
    }

    /**
     * @param Request $request
     * @return Request
     */
    protected function setDefaultCompanyForOwnerOrRestaurateur(&$request)
    {
        if (Auth::user()->is_owner || Auth::user()->is_restaurant) {
            $request['brand_id'] = Auth::user()->brand->first();
        }
    }

    /**
     * @return Pickup[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function retrieveOfferByUserRole()
    {
        if (Auth::user()->is_super) {
            $pickups = Pickup::all();

        } else {
            if (!Auth::user()->brand->first()) {
                return new Collection();
            }
            $pickups = Pickup::whereIn(
                'restaurant_id',
                Auth::user()->brand->first()->restaurants->toArray())
                ->get();
        }
        return $pickups;
    }


    public function approved(Pickup $pickup)
    {
        $pickup->status_pickup = 'APPROVED';
        return $this->changeStatus($pickup);
    }

    public function pending(Pickup $pickup)
    {

        $pickup->status_pickup = 'PENDING';
        return $this->changeStatus($pickup);
    }

    protected function changeStatus(Pickup $pickup)
    {
        try {
            $pickup->save();
            return response()->json($pickup, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Something was wrong'], 500);
        }
    }

}
