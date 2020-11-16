<?php

namespace App\Http\Controllers;

use App\Traits\TranslationTrait;
use App\Models\LoyaltyCardProduct;
use App\Models\LoyaltyCardProductRestaurant;
use App\Models\LoyaltyCardProductTranslations;
use App\Models\CategoryLoyaltyCardProduct;
use App\Models\MenuSection;
use App\Models\Menu;
use App\Models\Pickup;
use App\Models\PickupSubscription;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\PickupMealtype;
use App\Models\PickupProduct;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Services\ApplicationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoyaltyCardController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    use TranslationTrait; 

    public function validation(Request $request)
    {
        $validation = [
            'brand_id' => ['required', new \App\Rules\BrandBelongsToOwner],
            'restaurant_id' => ['required', new \App\Rules\RestaurantBelongsToCompany],
            'price' => ['required'],
            'quantity_offer' => ['required', 'integer'],
            'date' => ['required'],
            'timeslot_id' => ['required', 'array'],
            'product' => ['required', 'integer'],
            'card_validity' => ['required', 'integer'],
            'discount' => ['required', 'integer'],
            'item_availablity' => ['required', 'integer'],
            'media' => ['required', 'array'],
        ];

        $request->validate(
            $validation
        );

    }

    public function create()
    {

        $loyalty_card_restaurant = new LoyaltyCardProductRestaurant;
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
                'loyalty_card_restaurant' => $loyalty_card_restaurant,
                'loyaltyCardProduct' => $loyaltyCardProduct,
                'loyalty_card_items' => $items,
                'discount' => $discount,
                'validity' => $validity,
                'loyalty_card_availability' => $availability,
            ]
        );

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
            $total_amount = number_format((float)$price * $fields['quantity_offer'], 2, '.', '');
            $discount_amount = number_format((float)($total_amount*$fields['discount'])/100, 2, '.', '');
            $amount_to_pay = number_format((float)$total_amount - $discount_amount, 2, '.', '');
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
                    'quantity_offer' => $fields['quantity_offer'],
                    'quantity_remain' => $fields['quantity_offer']
                ]);
                $newPickupSubscription = PickupSubscription::create([
                    'product_id' => $newProductId,
                    'pickup_id' => $newPickupId,
                    'type_offer' => 'loyalty_card',
                    'quantity_offer' => $fields['quantity_offer'],
                    'price' => $price,
                    'validate_months' => $fields['card_validity'],
                    'discount' => $fields['discount'],
                    'total_amount' => $amount_to_pay,
                    'quantity_per_subscription' => $fields['item_availablity'],
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
                    'quantity_offer' => $fields['quantity_offer'],
                    'quantity_remain' => $fields['quantity_offer']
                ]);
                $newPickupSubscription = PickupSubscription::create([
                    'product_id' => $isProductexist->first()->product_id,
                    'pickup_id' => $newPickupId,
                    'type_offer' => 'loyalty_card',
                    'quantity_offer' => $fields['quantity_offer'],
                    'quantity_remain' => $fields['quantity_offer'],
                    'price' => $price,
                    'validate_months' => $fields['card_validity'],
                    'discount' => $fields['discount'],
                    'total_amount' => $amount_to_pay,
                    'quantity_per_subscription' => $fields['item_availablity'],
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