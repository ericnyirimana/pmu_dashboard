<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            //if ($pickup->orders->count() > 0 && $pickup->is_active_today) {
            if ($pickup->orders->count() > 0 &&
               (isset($request->all()['suspended']) && $request->all()['suspended'] == 1) ) {

            } else {
                $validation += [
                    'price' => ['required', 'integer'],
                    'media' => ['required', 'array'],
                    'products' => ['required', 'array'],
                    'quantity_offer' => ['required', 'integer'],
                    'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
                    'restaurant_id' => ['required', new \App\Rules\RestaurantBelongsToCompany],
                    'date' => ['required'],
                    'timeslot_id' => ['required', new \App\Rules\TimeslotBelongsToRestaurant]
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

        return redirect()->route('pickups.edit', $pickup);
        /*
         return redirect()->route('pickups.edit', $pickup)->with([
            'notification' => trans('messages.notification.pickup_saved'),
            'type-notification' => 'success'
        ]);
         */

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

        /*
        if( ($fields['check_media'] == null) ||
            (isset($fields['suspended']) && $fields['suspended'] == 0) ){
            $this->validation($request, $pickup);
        }*/

        if (isset($fields['date'])) {
            $dates = explode('|', $fields['date']);

            $fields['date_ini'] = Carbon::parse($dates[0]);
            $fields['date_end'] = Carbon::parse($dates[1]);
        }
/*
        if ($pickup->products->count() > 0 && $fields['quantity_offer'] < $pickup->quantity_offer) {
            return redirect()->route('pickups.edit', $pickup)->with([
                'notification' => trans('messages.notification.pickup_quantity_wrong'),
                'type-notification' => 'danger'
            ]);
        }
*/
        //$totalProductsQuantity = 0;
        foreach ($fields['products'] as $k => $v) {
            //$totalProductsQuantity += $fields['quantity'][$k];
            $products[$v] = ['quantity_offer' => $fields['quantity'][$k]];
        }

        //Check the total quantity
        $sections = $pickup->sections;
        if( $pickup->sections == null ){
            $sections = $this->getSections($fields['products']);
        }

/*
        if ($fields['quantity_offer'] > $totalProductsQuantity) {
            return redirect()->route('pickups.edit', $pickup)->with([
                'notification' => trans('messages.notification.pickup_quantity_wrong'),
                'type-notification' => 'danger'
            ]);
        }
*/
        foreach ($sections as $k => $v) {
            $sectionKey = $k;
            $sumProductsQuantityPerSection = 0;
            foreach ($sections[$k] as $sectionK => $sectionV) {
                if( isset($products[$sectionV->id]) ){
                    $sumProductsQuantityPerSection += $products[$sectionV->id]['quantity_offer'];
                }
            }
            if( $sumProductsQuantityPerSection < $fields['quantity_offer'] ){
                return response()->json(['errors' => ['quantity' => Array(trans('messages.notification.pickup_quantity_wrong',
                    ['section' => $sectionKey, 'total_section' => $sumProductsQuantityPerSection]))]], 422);
            }
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
            'notification' => trans('messages.notification.pickup_saved', ['pickup_name' => $pickup->name]),
            'type-notification' => 'success'
        ]);

    }

    private function getSections($products){

        if (count($products) > 0) {
            foreach ($products as $productItem) {

                $product = Product::where('id', '=', $productItem)->first();
                $pos = $product->section->name;
                if (empty($list[$pos])) $list[$pos] = array();

                array_push($list[$pos], $product);

            }

            return $list;
        }
    }

    public function destroy(Pickup $pickup)
    {

        $msg = 'messages.notification.pickup_removed';
        if( $pickup->ordersToday()->count() > 0 ){
            //Can't Delete Pickup Offers
            $msg = 'messages.notification.pickup_cant_remove';
        } else {
            //Delete Pickup Offers
            $pickup->delete();
        }

        return redirect()->route('pickups.index')->with([
            'notification' => trans($msg),
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
                Auth::user()->restaurant->pluck('id')->toArray())
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
