<?php

namespace App\Http\Controllers;

use App\Traits\TranslationTrait;
use App\Models\LoyaltyCardProduct;
use App\Models\LoyaltyCardProductRestaurant;
use App\Models\CategoryLoyaltyCardProduct;
use App\Models\MenuSection;
use App\Models\Menu;
use App\Models\Pickup;
use App\Models\PickupSubscription;
use App\Models\Product;
use App\Models\PickupMealtype;
use App\Models\PickupProduct;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\ApplicationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Auth;

class LoyaltyCardController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        // $this->authorizeResource(Pickup::class);
        $this->applicationService = $applicationService;
    }

    use TranslationTrait; 

    public function validation(Request $request)
    {
        $validation = [
            'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
            'restaurant_id' => ['required', new \App\Rules\RestaurantBelongsToCompany],
            'price' => ['required'],
            'quantity_per_subscription' => ['required', 'integer'],
            'date' => ['required'],
            'timeslot_id' => ['required', 'array'],
            'product' => ['required', 'integer'],
            'validate_months' => ['required', 'integer'],
            'discount' => ['required', 'integer'],
            'quantity_offer' => ['required', 'integer'],
            'media' => ['required', 'array'],
        ];

        $request->validate(
            $validation
        );

    }

    public function index()
    {

        $pickups = $this->retrieveOfferByUserRole();

        return view('admin.loyalty-card.index')
            ->with(compact('pickups'));

    }

    public function create()
    {

        $pickup = new LoyaltyCardProductRestaurant;
        $loyaltyCardProduct = LoyaltyCardProduct::get();
        $loyalty_card_items = $this->applicationService->getValue('LOYALTY_CARD_ITEMS');
        $items = array_combine($loyalty_card_items, $loyalty_card_items);
        $loyalty_card_discount = $this->applicationService->getValue('LOYALTY_CARD_DISCOUNT');
        $discount = $this->applicationService->concatenateArrayValue($loyalty_card_discount, '%');
        $loyalty_card_validity = $this->applicationService->getValue('LOYALTY_CARD_VALIDITY');
        $validity = $this->applicationService->concatenateArrayValue($loyalty_card_validity, trans('labels.months'));
        $loyalty_card_availability = $this->applicationService->getValue('LOYALTY_CARD_AVAILABILITY');
        $availability = array_combine($loyalty_card_availability, $loyalty_card_availability);
        return view('admin.loyalty-card.create')->with([
                'pickup' => $pickup,
                'loyaltyCardProduct' => $loyaltyCardProduct,
                'loyalty_card_items' => $items,
                'discount' => $discount,
                'validity' => $validity,
                'loyalty_card_availability' => $availability,
            ]
        );

    }


    protected function retrieveOfferByUserRole()
    {
        if (Auth::user()->is_super) {

            $pickups = Pickup::leftJoin('pickup_subscriptions', function ($join)  {
                $join->on('pickup_subscriptions.pickup_id', '=', 'pickups.id');
            })
                ->where(function ($q) {
                    $q->where('pickup_subscriptions.type_offer', '=', 'loyalty_card');
                })
                ->select('pickups.*')
                ->orderBy('pickups.created_at', 'desc')
                ->get();

        } else {
            if (!Auth::user()->brand->first()) {
                return new \Illuminate\Database\Eloquent\Collection();
            }

            $pickups = Pickup::leftJoin('pickup_subscriptions', function ($join)  {
                $join->on('pickup_subscriptions.pickup_id', '=', 'pickups.id');
            })
                ->where(function ($q) {
                    $q->where('pickup_subscriptions.type_offer', '=', 'loyalty_card');
                })
                ->whereIn('pickups.restaurant_id', Auth::user()->restaurant->pluck('id')->toArray())
                ->select('pickups.*')
                ->orderBy('pickups.created_at', 'desc')
                ->get();
        }
        return $pickups;
    }

    public function store(Request $request)
    {
        
        $this->validation($request);
        try {
            $fields = $request->all();
            $dates = explode('|', $fields['date']);
            $fields['date_ini'] = Carbon::parse($dates[0]);
            $fields['date_end'] = Carbon::parse($dates[1]);
            $timeslots = $fields['timeslot_id'];
            unset($fields['timeslot_id']);
            $product = $fields['product'];
            $restaurant = $fields['restaurant_id'];
            $priceNewFormat = str_replace(',','.',$fields['price']);
            settype($priceNewFormat, "float");
            $price = number_format((float)$priceNewFormat, 2, '.', '');
            $total_amount = number_format((float)$price * $fields['quantity_per_subscription'], 2, '.', '');
            $discount_amount = number_format((float)($total_amount*$fields['discount'])/100, 2, '.', '');
            $isProductexist = LoyaltyCardProductRestaurant::where('restaurant_id', $restaurant)
                            ->where('loyalty_card_product_id', $product)->get();
            $productInfo = LoyaltyCardProduct::where('id', $product)->get()->first();
            $productTranslationInfo = LoyaltyCardProduct::where('id', $product)->first()->toArray();
            DB::beginTransaction();
            if($isProductexist->count() == 0){
                // $restaurantHasLoyaltyCard = Product::where('restaurant_id', $restaurant)
                //                             ->where('type', 'Loyalty Card')->get();
                $menu = Menu::where('restaurant_id', $restaurant)->get()->first();
                $menuSection = MenuSection::where('menu_id', $menu->id)->get();
                if($menuSection->where('type','LoyaltyCard')->count() == 0){
                    $menuSectionFields = [
                        'name' => 'Loyalty Card',
                        'type' => 'LoyaltyCard',
                        'position' => $menuSection->count(),
                    ];
                    $newSection = $menu->sections()->create($menuSectionFields);
                    $newSectionId = $newSection->id;
                    $this->saveTranslation($newSection, $menuSectionFields);
                }
                else {
                    $newSectionId = $menuSection->where('type','LoyaltyCard')->first()->id;
                }
                $productFields = [
                    'name' => $productInfo->name,
                    'price' => $price,
                    'restaurant_id' => $restaurant,
                    'menu_section_id' => $newSectionId,
                    'type' => $productInfo->type,
                    'status_product' => 'APPROVED',
                ];
                $newProduct = Product::create($productFields);
                $newProductId = $newProduct->id;
                $this->saveTranslation($newProduct, $productFields);
                $this->saveProductCategories($newProductId, $product);
                $newProductRestaurant = LoyaltyCardProductRestaurant::create([
                    'restaurant_id' => $restaurant,
                    'product_id' => $newProductId,
                    'loyalty_card_product_id' => $product
                ]);
                $pickupFields = [
                    'name' => $productInfo->name,
                    'type_pickup' => 'subscription',
                    'timeslot' => 0,
                    'restaurant_id' => $restaurant,
                    'date_ini' => $fields['date_ini'],
                    'date_end' => $fields['date_end'],
                    'suspended' => 0];
                $newPickup = Pickup::create($pickupFields);
                $this->saveTranslation($newPickup, $pickupFields);
                if ($request->media) {
                    $newPickup->media()->sync(array_unique($request->media));
                }
                $newPickupId = $newPickup->id;
                $this->savePickupMealtype($newPickupId, $timeslots);
                $newPickupProduct = PickupProduct::create([
                    'product_id' => $newProductId,
                    'pickup_id' => $newPickupId,
                    'quantity_offer' => $fields['quantity_per_subscription'],
                    'quantity_remain' => $fields['quantity_per_subscription']
                ]);
                $newPickupSubscription = PickupSubscription::create([
                    'pickup_id' => $newPickupId,
                    'type_offer' => 'loyalty_card',
                    'quantity_offer' => $fields['quantity_offer'],
                    'price' => $price,
                    'validate_months' => $fields['validate_months'],
                    'discount' => $fields['discount'],
                    'total_amount' => $total_amount,
                    'quantity_per_subscription' => $fields['quantity_per_subscription'],
                    'usable_company' => $fields['usable_company'] ?? 0,
                ]);
            }
            else {
                $pickupFields = [
                    'name' => $productInfo->name,
                    'type_pickup' => 'subscription',
                    'timeslot' => 0,
                    'restaurant_id' => $restaurant,
                    'date_ini' => $fields['date_ini'],
                    'date_end' => $fields['date_end'],
                    'suspended' => 0];
                $newPickup = Pickup::create($pickupFields);
                $this->saveTranslation($newPickup, $pickupFields);
                if ($request->media) {
                    $newPickup->media()->sync(array_unique($request->media));
                }
                $newPickupId = $newPickup->id;
                $this->savePickupMealtype($newPickupId, $timeslots);
                $newPickupProduct = PickupProduct::create([
                    'product_id' => $isProductexist->first()->product_id,
                    'pickup_id' => $newPickupId,
                    'quantity_offer' => $fields['quantity_per_subscription'],
                    'quantity_remain' => $fields['quantity_per_subscription']
                ]);
                $newPickupSubscription = PickupSubscription::create([
                    'pickup_id' => $newPickupId,
                    'type_offer' => 'loyalty_card',
                    'quantity_offer' => $fields['quantity_offer'],
                    'quantity_remain' => $fields['quantity_offer'],
                    'price' => $price,
                    'validate_months' => $fields['validate_months'],
                    'discount' => $fields['discount'],
                    'total_amount' => $total_amount,
                    'quantity_per_subscription' => $fields['quantity_per_subscription'],
                    'usable_company' => $fields['usable_company'] ?? 0,
                ]);
            }
            DB::commit();
            return response()->json(['success' => 'Loyalty card successfully add'], 200);
        } catch (\Throwable $exception){
            Log::info('An error occurred {' . $exception . '}');
            DB::rollback();
            return response()->json(['error' => 'Something went wrong'], 500);
         }

    }

    public function update(Request $request, Pickup $loyalty_card)
    {
        
        $this->validation($request);
        try {
            $fields = $request->all();
            $dates = explode('|', $fields['date']);
            $fields['date_ini'] = Carbon::parse($dates[0]);
            $fields['date_end'] = Carbon::parse($dates[1]);
            $timeslots = $fields['timeslot_id'];
            unset($fields['timeslot_id']);
            $product = $fields['product'];
            $restaurant = $fields['restaurant_id'];
            $priceNewFormat = str_replace(',','.',$fields['price']);
            settype($priceNewFormat, "float");
            $price = number_format((float)$priceNewFormat, 2, '.', '');
            $total_amount = number_format((float)$price * $fields['quantity_per_subscription'], 2, '.', '');
            $discount_amount = number_format((float)($total_amount*$fields['discount'])/100, 2, '.', '');
            $isProductexist = LoyaltyCardProductRestaurant::where('restaurant_id', $restaurant)
                            ->where('loyalty_card_product_id', $product)->get();
            $productInfo = LoyaltyCardProduct::where('id', $product)->get()->first();
            $productTranslationInfo = LoyaltyCardProduct::where('id', $product)->first()->toArray();
            DB::beginTransaction();
            if($isProductexist->count() == 0){
                $menu = Menu::where('restaurant_id', $restaurant)->get()->first();
                $menuSection = MenuSection::where('menu_id', $menu->id)->get();
                if($menuSection->where('type','LoyaltyCard')->count() == 0){
                    $menuSectionFields = [
                        'name' => 'Loyalty Card',
                        'type' => 'LoyaltyCard',
                        'position' => $menuSection->count(),
                    ];
                    $newSection = $menu->sections()->create($menuSectionFields);
                    $newSectionId = $newSection->id;
                    $this->saveTranslation($newSection, $menuSectionFields);
                }
                else {
                    $newSectionId = $menuSection->where('type','LoyaltyCard')->first()->id;
                }
                $productFields = [
                    'name' => $productInfo->name,
                    'price' => $price,
                    'restaurant_id' => $restaurant,
                    'menu_section_id' => $newSectionId,
                    'type' => $productInfo->type,
                    'status_product' => 'APPROVED',
                ];
                $newProduct = Product::create($productFields);
                $newProductId = $newProduct->id;
                $this->saveTranslation($newProduct, $productFields);
                $this->saveProductCategories($newProductId, $product);
                $newProductRestaurant = LoyaltyCardProductRestaurant::create([
                    'restaurant_id' => $restaurant,
                    'product_id' => $newProductId,
                    'loyalty_card_product_id' => $product
                ]);
                $pickupFields = [
                    'name' => $productInfo->name,
                    'type_pickup' => 'subscription',
                    'timeslot' => 0,
                    'restaurant_id' => $restaurant,
                    'date_ini' => $fields['date_ini'],
                    'date_end' => $fields['date_end'],
                    'suspended' => 0];
                $loyalty_card->update($pickupFields);
                $this->saveTranslation($loyalty_card, $pickupFields);
                if ($request->media) {
                    $loyalty_card->media()->sync(array_unique($request->media));
                }
                $this->savePickupMealtype($loyalty_card->id, $timeslots);
                $newPickupProduct = PickupProduct::where('pickup_id', $loyalty_card->id)->update([
                    'product_id' => $newProductId,
                    'quantity_offer' => $fields['quantity_per_subscription'],
                    'quantity_remain' => $fields['quantity_per_subscription']
                ]);
                $newPickupSubscription = PickupSubscription::where('pickup_id', $loyalty_card->id)->update([
                    'type_offer' => 'loyalty_card',
                    'quantity_offer' => $fields['quantity_offer'],
                    'price' => $price,
                    'validate_months' => $fields['validate_months'],
                    'discount' => $fields['discount'],
                    'total_amount' => $total_amount,
                    'quantity_per_subscription' => $fields['quantity_per_subscription'],
                    'usable_company' => $fields['usable_company'] ?? 0,
                ]);
            }
            else {
                $pickupFields = [
                    'name' => $productInfo->name,
                    'type_pickup' => 'subscription',
                    'timeslot' => 0,
                    'restaurant_id' => $restaurant,
                    'date_ini' => $fields['date_ini'],
                    'date_end' => $fields['date_end'],
                    'suspended' => 0];
                $loyalty_card->update($pickupFields);
                if ($request->media) {
                    $loyalty_card->media()->sync(array_unique($request->media));
                }
                $this->savePickupMealtype($loyalty_card->id, $timeslots);
                $newPickupProduct = PickupProduct::where('pickup_id', $loyalty_card->id)->update([
                    'product_id' => $isProductexist->first()->product_id,
                    'quantity_offer' => $fields['quantity_per_subscription'],
                    'quantity_remain' => $fields['quantity_per_subscription']
                ]);
                $newPickupSubscription = PickupSubscription::where('pickup_id', $loyalty_card->id)->update([
                    'type_offer' => 'loyalty_card',
                    'quantity_offer' => $fields['quantity_offer'],
                    'quantity_remain' => $fields['quantity_offer'],
                    'price' => $price,
                    'validate_months' => $fields['validate_months'],
                    'discount' => $fields['discount'],
                    'total_amount' => $total_amount,
                    'quantity_per_subscription' => $fields['quantity_per_subscription'],
                    'usable_company' => $fields['usable_company'] ?? 0,
                ]);
            }
            DB::commit();
            return response()->json(['success' => 'Loyalty card successfully updated'], 200);
        } catch (\Throwable $exception){
            Log::info('An error occurred {' . $exception . '}');
            DB::rollback();
            return response()->json(['error' => 'Something went wrong'], 500);
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

    protected function saveProductCategories($productId, $loyaltyCardProductId)
    {

        if (isset($productId) && isset($loyaltyCardProductId)) {
            $getAllCategories = CategoryLoyaltyCardProduct::where('loyalty_card_product_id', $loyaltyCardProductId)->get();
            foreach ($getAllCategories as $key => $categories) {
                CategoryProduct::create([
                    'category_id' => $categories->category_id,
                    'product_id' => $productId,
                ]);
            }
        }

    }

}
