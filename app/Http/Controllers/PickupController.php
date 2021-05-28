<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


use App\Models\Pickup;
use App\Models\PickupSubscription;
use App\Models\LoyaltyCardProduct;
use App\Models\Media;
use App\Models\PickupMealtype;
use App\Models\OrderProduct;
use App\Models\PickupProduct;
use App\Models\Restaurant;
use App\Traits\TranslationTrait;
use Carbon\Carbon;
use App\Services\ApplicationService;
use App\Models\LoyaltyCardProductRestaurant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Auth;

class PickupController extends Controller
{

    use TranslationTrait;


    public function __construct(ApplicationService $applicationService)
    {

        $this->authorizeResource(Pickup::class);
        $this->applicationService = $applicationService;

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

            }
            elseif((isset($request->all()['type_pickup']) && $request->all()['type_pickup'] == 'subscription') ){
                if((isset($request->all()['suspended']) && $request->all()['suspended'] == 0) && $pickup->suspended == 1 || (!isset($request->all()['suspended']) && $pickup->status_pickup == trans('labels.pickup_status.progress'))){
                    $validation += [
                        'price' => ['required'],
                        'media' => ['required', 'array'],
                        'products' => ['required', 'array'],
                        'quantity_offer' => ['required', 'integer'],
                        'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
                        'restaurant_id' => ['required', new \App\Rules\RestaurantBelongsToCompany],
                        'date' => ['required'],
                        'validate_months' => ['required'],
                        'quantity_per_subscription' => ['required', 'integer'],
                    ];
                }
                else{
                    $validation += [
                        'price' => ['required'],
                        'products' => ['required', 'array'],
                        'quantity_offer' => ['required', 'integer'],
                        'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
                        'restaurant_id' => ['required', new \App\Rules\RestaurantBelongsToCompany],
                        'date' => ['required'],
                        'validate_months' => ['required'],
                        'quantity_per_subscription' => ['required', 'integer'],
                    ];
                }
            }
            else {
                if(((isset($request->all()['suspended']) && $request->all()['suspended'] == 0) && $pickup->suspended == 1) || (!isset($request->all()['suspended']) && $pickup->status_pickup == trans('labels.pickup_status.progress'))){
                    $validation += [
                        'price' => ['required', 'integer'],
                        'media' => ['required', 'array'],
                        'products' => ['required', 'array'],
                        'quantity_offer' => ['required', 'integer'],
                        'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
                        'restaurant_id' => ['required', new \App\Rules\RestaurantBelongsToCompany],
                        'date' => ['required'],
                        'timeslot_id' => ['required', 'array']
                    ];
                }
                else{
                    $validation += [
                        'price' => ['required', 'integer'],
                        'products' => ['required', 'array'],
                        'quantity_offer' => ['required', 'integer'],
                        'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
                        'restaurant_id' => ['required', new \App\Rules\RestaurantBelongsToCompany],
                        'date' => ['required'],
                        'timeslot_id' => ['required', 'array']
                    ];
                }
            }
        } else {
            if ((isset($request->all()['type_pickup']) && $request->all()['type_pickup'] == 'subscription') ) {
                $validation = [
                    'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
                    'restaurant_id' => ['required_if:role,ADMIN,OWNER', new \App\Rules\RestaurantBelongsToCompany],
                    'date' => ['required']
                ];
            }
            else{
                $validation = [
                    'type_pickup' => 'required',
                    'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
                    'restaurant_id' => ['required_if:role,ADMIN,OWNER', new \App\Rules\RestaurantBelongsToCompany],
                    'date' => ['required'],
                    'timeslot_id' => ['required', 'array']

                ];
            }
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
        $restaurant = Restaurant::find($fields['restaurant_id']);
        if(!$restaurant->menu()->first()->is_approved){
            return redirect()->route('pickups.create')->with([
                'notification' => trans('messages.notification.menu_for_approval'),
                'type-notification' => 'danger'
            ]);
        }
        if($fields['type_pickup'] == 'subscription'){
            $timeslots = array();
            $restaurantTimeslots = $restaurant->timeslots;
            foreach($restaurantTimeslots as $restaurantTimeslot){
                if($restaurantTimeslot->mealtype->all_day == 1){
                    array_push($timeslots, $restaurantTimeslot->mealtype_id);
                }
            }
        }
        else{
            $timeslots = $fields['timeslot_id'];
            unset($fields['timeslot_id']);
        }
        $pickup = Pickup::create($fields);
        if ($pickup->type_pickup == 'offer') {
            $pickup->offer()->create(['type_offer' => 'single', 'quantity_offer' => '10', 'price' => 7]);
        } else {
            $pickup->subscription()->create(['type_offer' => 'single', 'quantity_offer' => '10', 'price' => 7, 'validate_months' => 5]);
        }
        $this->saveTranslation($pickup, $fields);
        $this->savePickupMealtype($pickup->id, $timeslots);
        if ($request->media) {
            $pickup->media()->sync(array_unique($request->media));
        }

        return redirect()->route('pickups.edit', $pickup)->with([
            'first_edit' => true,
        ]);
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
        $pickup_mealtype = PickupMealtype::where('pickup_id', $pickup->id)->get();
        $subscription_validity = $this->applicationService->getValue('SUBSCRIPTION_VALIDITY');
        $month_validity = $this->applicationService->concatenateArrayValue($subscription_validity, trans('labels.months'));
        $subscription_items = $this->applicationService->getValue('SUBSCRIPTION_ITEMS');
        $items = array_combine($subscription_items, $subscription_items);
        $isLoyaltyCard = $this->isPickupLoyaltyCard($pickup->id);
        if($isLoyaltyCard == true){
            $loyalty_card_items = $this->applicationService->getValue('LOYALTY_CARD_ITEMS');
            $pickupProduct = PickupProduct::where('pickup_id', $pickup->id)->first();
            $loyaltyCardProduct = LoyaltyCardProduct::get();
            $selectedProductId = LoyaltyCardProductRestaurant::where('product_id',$pickupProduct->product_id)->first();
            $items = array_combine($loyalty_card_items, $loyalty_card_items);
            $loyalty_card_discount = $this->applicationService->getValue('LOYALTY_CARD_DISCOUNT');
            $discount = $this->applicationService->concatenateArrayValue($loyalty_card_discount, '%');
            $loyalty_card_validity = $this->applicationService->getValue('LOYALTY_CARD_VALIDITY');
            $validity = $this->applicationService->concatenateArrayValue($loyalty_card_validity, trans('labels.months'));
            $loyalty_card_availability = $this->applicationService->getValue('LOYALTY_CARD_AVAILABILITY');
            $availability = array_combine($loyalty_card_availability, $loyalty_card_availability);
            return view('admin.loyalty-card.edit')->with([
                'pickup' => $pickup,
                'pickup_mealtype' => $pickup_mealtype,
                'loyaltyCardProduct' => $loyaltyCardProduct,
                'loyalty_card_items' => $items,
                'discount' => $discount,
                'validity' => $validity,
                'selected_product_id' => $selectedProductId,
                'loyalty_card_availability' => $availability,
                'media' => $media,
            ]);
        }
        if($menu == null){
            return redirect()->route('pickups.index')->with([
                'notification' => trans('messages.notification.menu_for_approval'),
                'type-notification' => 'danger'
            ]);
        }
        return view('admin.pickups.edit')->with([
                'pickup' => $pickup,
                'menu' => $menu,
                'media' => $media,
                'pickup_mealtype' => $pickup_mealtype,
                'month_validity' => $month_validity,
                'subscription_items' => $items,
                'max_quantity_per_section' => 5,
                'min_quantity_per_section' => 1,
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
        foreach ($fields['products'] as $k => $v) {
                $products[$v] = ['quantity_offer' => $fields['quantity'][$k],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()];
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

        if ($pickup->type_pickup == 'offer') {
        $timeslots = $fields['timeslot_id'];
        unset($fields['timeslot_id']);
        }

        $pickup->pickupSection()->delete();
        foreach($fields['menu_section_identifier'] as $key => $value){
            if($fields['quantity_per_section'][$key] > 1){
                $fields['type_offer'] = 'multiple';
            }
            if($pickup->pickupSection()->withTrashed()->where('menu_section_identifier', $fields['menu_section_identifier'][$key])->count() > 0){
                $pickup->pickupSection()->withTrashed()->where('menu_section_identifier', $fields['menu_section_identifier'][$key])->update(
                    ['quantity_min_per_section' => $fields['quantity_per_section'][$key],
                    'quantity_max_per_section' => $fields['quantity_per_section'][$key],
                    'deleted_at' => NULL,
                ]);

            } else {
                $pickup->pickupSection()->withTrashed()->create(
                    ['menu_section_id' => $fields['menu_section_id'][$key],
                    'menu_section_identifier' => $fields['menu_section_identifier'][$key],
                    'quantity_min_per_section' => $fields['quantity_per_section'][$key],
                    'quantity_max_per_section' => $fields['quantity_per_section'][$key],
                    'deleted_at' => NULL,
                ]);

            }
        }

        $pickup->update($fields);
        if ($pickup->type_pickup == 'offer') {
            $pickup->offer->update($fields);
        } else {
            $subscription_discount = $this->applicationService->getValue('SUBSCRIPTION_DISCOUNT');
            $total_amount = number_format((float)$fields['price'] * $fields['quantity_per_subscription'], 2, '.', '');
            $discount_amount = number_format((float)($total_amount * $subscription_discount)/100, 2, '.', '');
            $fields['discount'] = $subscription_discount;
            $fields['total_amount'] = $total_amount; // - $discount_amount;
            $pickup->subscription->update($fields);
        }

        $this->saveTranslation($pickup, $fields);
        if ($pickup->type_pickup == 'offer') {
        $this->savePickupMealtype($pickup->id, $timeslots);
        }
        PickupProduct::where('pickup_id', $pickup->id)->delete();
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
            if($pickup->type_pickup == 'offer'){
                $pickup->offer()->delete();
                $pickup->pickupSection()->delete();
                $pickup->delete();
            } else {
                $pickup->subscription()->delete();
                $pickup->delete();
            }
        }
        $isLoyaltyCard = $this->isPickupLoyaltyCard($pickup->id);
        if($isLoyaltyCard == true){
            return redirect()->route('loyalty-card.index')->with([
                'notification' => trans($msg),
                'type-notification' => 'warning'
            ]);
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
                $pickup->offer->quantity_offer, 'price' => $pickup->offer->price, 'validate_months' =>
                $pickup->offer->validate_months]);
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
            //$pickups = Pickup::all();

            $pickups = Pickup::leftJoin('pickup_subscriptions', function ($join)  {
                $join->on('pickup_subscriptions.pickup_id', '=', 'pickups.id');
            })
                ->where(function ($q) {
                    $q->where('pickup_subscriptions.type_offer', '<>', 'loyalty_card');
                    $q->orWhere('pickup_subscriptions.type_offer', '=', null);
                })
                ->select('pickups.*')
                ->orderBy('pickups.created_at', 'desc')
                ->get();

        } else {
            if (!Auth::user()->brand->first()) {
                return new Collection();
            }

            $pickups = Pickup::leftJoin('pickup_subscriptions', function ($join)  {
                $join->on('pickup_subscriptions.pickup_id', '=', 'pickups.id');
            })
                ->where(function ($q) {
                    $q->where('pickup_subscriptions.type_offer', '<>', 'loyalty_card');
                    $q->orWhere('pickup_subscriptions.type_offer', '=', null);
                })
                ->whereIn('pickups.restaurant_id', Auth::user()->restaurant->pluck('id')->toArray())
                ->select('pickups.*')
                ->orderBy('pickups.created_at', 'desc')
                ->get();
            /*
            $pickups = Pickup::whereIn(
                'restaurant_id',
                Auth::user()->restaurant->pluck('id')->toArray())
                ->get();*/
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

    protected function savePickupMealtype(int $pickup, array $fields)
    {

        if ($fields) {
            // clean all pickup mealtype
            PickupMealtype::where('pickup_id', $pickup)->delete();
            foreach ($fields as $field => $list) {
                $checkIfExist = PickupMealtype::withTrashed()
                                ->where('pickup_id', $pickup)
                                ->where('mealtype_id', $list)->count();
                if($checkIfExist == 0){
                    PickupMealtype::create([
                        'pickup_id' => $pickup,
                        'mealtype_id' => $list,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
                else {
                    PickupMealtype::withTrashed()->where('pickup_id', $pickup)
                        ->where('mealtype_id', $list)
                        ->update(['deleted_at' => null]);
                }

            }
        }

    }

    public function isProductOrdered(Request $request)
    {
        try {
            $pickup = Pickup::find($request->pickup);
            $product = Product::find($request->product);
            if($pickup->suspended == 0){
                $productOrdered = OrderProduct::where('pickup_id', $pickup->id)
                                ->where('product_id', $product->id)
                                ->where('status', 'ENABLED')
                                ->where('date', Carbon::today())->count();
                if ($productOrdered > 0) {
                    return response()->json(['error' => Array(trans('messages.notification.pickup_product_is_ordered',
                        ['product' =>$product->name]))], 400);
                }
                return response()->json(['success' => $product->name.' has not been ordered'], 200);
            }
            return response()->json(['success' => $product->name.' has not been ordered'], 200);
        }
        catch (\Exception $exception) {
            return response()->json(['error' => 'Something was wrong'], 500);
        }
    }

    public function isMenuOrdered(Request $request)
    {
        try {
            $pickup = Pickup::find($request->pickup);
            $products = Product::where('menu_section_id',$request->menu_section_id)->get();
            if($pickup->suspended == 0){
                foreach ($products as $key => $value) {
                    $productOrdered = OrderProduct::where('pickup_id', $pickup->id)
                                    ->where('product_id', $value->id)
                                    ->where('status', 'ENABLED')
                                    ->where('date', Carbon::today())->count();
                    if ($productOrdered > 0) {
                        return response()->json(['error' => Array(trans('messages.notification.pickup_product_is_ordered',
                        ['product' => $value->name]))], 400);
                    }
                }
                return response()->json(['success' => 'Menu has not been ordered'], 200);
            }
            return response()->json(['success' => 'Menu has not been ordered'], 200);
        }
        catch (\Exception $exception) {
            return response()->json(['error' => 'Something was wrong'], 500);
        }
    }

    protected function isPickupLoyaltyCard($pickupId)
    {
        $pickups = PickupSubscription::where('pickup_id', $pickupId)->where('type_offer', 'loyalty_card')->count();
        if($pickups > 0){
            return true;
        }

        return false;
    }
}
