<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Company;
use App\Models\Restaurant;
use App\Models\Category;
use App\Traits\TranslationTrait;
use Illuminate\Support\Facades\Log;

use Auth;
use Illuminate\Support\Collection;

class ProductController extends Controller
{

    use TranslationTrait;


    public function __construct()
    {

        $this->authorizeResource(Product::class);

    }

    public function validation(Request $request, $media = null)
    {

        $request->validate(
            [
                'name' => 'required',
                'brand_id' => new \App\Rules\ProductBelongsToCompany(),
            ]
        );

    }


    public function index()
    {

        if(Auth::user()->is_restaurant){
            $products = Auth::user()->restaurant()->first()->products
            ->sortByDesc('created_at');
        }
        else {
            if (Auth::user()->brand->first()) {
                $products = Auth::user()->brand->first()->products
                ->sortByDesc('created_at');
            } else {
                $products = new Collection();
            }

        }

        return view('admin.products.index')
            ->with(compact('products'));


    }


    public function create(Request $request)
    {
        $route = \Request::route()->getName();
        $arrRoute = explode('.', $route);

        $product = new Product();
        $product->type = ucfirst(end($arrRoute));
        $restaurant = null;

        if (Auth::user()->is_super) {
            if(isset($request->all()['restaurant'])){
                $restaurant_id = $request->all()['restaurant'];
                $restaurant = Restaurant::find($restaurant_id);
                $companies = $restaurant->company()->first();
            }
            else{
            $companies = Company::all();
            }

        } else {
            $companies = Auth::user()->brand->first();
        }

        $foods = Category::where('type', 'Food')->with('translate')->get()->pluck('translate.name');
        $allergens = Category::where('type', 'Allergen')->with('translate')->get()->pluck('translate.name');
        $dietaries = Category::where('type', 'Dietary')->with('translate')->get()->pluck('translate.name');

        return view('admin.products.create')->with([
                'product' => $product,
                'companies' => $companies,
                'brand' => $companies,
                'restaurant' => $restaurant,
                'foods' => $foods,
                'allergens' => $allergens,
                'dietaries' => $dietaries
            ]
        );

    }


    public function store(Request $request)
    {

        $this->validation($request);

        $fields = $request->all();
        // dd($fields);
        $fields['type'] = $request->type ?? 'Dish';
        $fields['status'] = $request->status ?? false;
        // if products is only updated set to DRAFT status
        if (!isset($fields['status_product'])) {
            $fields['status_product'] = 'DRAFT';
        }

        if ($fields['restaurant_id'] == '_all' && $fields['type'] == 'Dish') {
            return redirect()->route('products.create.dish')->with([
                'notification' => trans('messages.notification.select_restaurant'),
                'type-notification' => 'danger'
            ]);
        } elseif ($fields['restaurant_id'] == '_all' && $fields['type'] == 'Drink') {
            return redirect()->route('products.create.drink')->with([
                'notification' => trans('messages.notification.select_restaurant'),
                'type-notification' => 'danger'
            ]);
        }

        $product = Product::create($fields);

        $this->saveTranslation($product, $fields);

        $this->saveCategories($product, $fields);

        if ($request->media) {
            $product->media()->sync(array_unique($request->media));
        }
        if(Auth::user()->is_super && (isset($fields['status_product']) && $fields['status_product'] === 'APPROVED')){
            return redirect()->route('products.create.'.strtolower($fields['type']), ['restaurant'=>$product->restaurant->id])->with([
                'notification' => trans('messages.notification.product_saved'),
                'type-notification' => 'success'
            ]); 
        }
        elseif(Auth::user()->is_super){
            return redirect()->route('products.filter.dishes', ['restaurant'=>$product->restaurant->id, 'brand'=>$product->company->id])->with([
                'notification' => trans('messages.notification.product_saved'),
                'type-notification' => 'success'
            ]); 
        }
        return redirect()->route('products.index')->with([
            'notification' => trans('messages.notification.product_saved'),
            'type-notification' => 'success'
        ]);

    }

    public function show(Product $product)
    {

        return view('admin.products.view')->with([
                'product' => $product,
            ]
        );

    }


    public function edit(Product $product)
    {

        if (Auth::user()->is_super) {
            $companies = Company::all();

        } else {
            $companies = Auth::user()->brand->first();
        }

        $foods = Category::where('type', 'Food')->with('translate')->get()->pluck('translate.name');
        $allergens = Category::where('type', 'Allergen')->with('translate')->get()->pluck('translate.name');
        $dietaries = Category::where('type', 'Dietary')->with('translate')->get()->pluck('translate.name');


        return view('admin.products.edit')->with([
                'product' => $product,
                'companies' => $companies,
                'foods' => $foods,
                'allergens' => $allergens,
                'dietaries' => $dietaries,
                'edit' => true
            ]
        );

    }

    public function update(Request $request, Product $product)
    {

        if(Auth::user()->is_owner || Auth::user()->is_restaurateur){
            return redirect()->route('products.index')->with([
                'notification' => trans('messages.notification.not_allowed_user'),
                'type-notification' => 'danger'
            ]);
        }

        $this->validation($request, $product);

        $fields = $request->all();

        $this->saveCategories($product, $fields);

        $product->update($fields);

        $this->saveTranslation($product, $fields);


        if ($request->media) {
            $product->media()->sync(array_unique($request->media));
        }

        $explode_prev_route = explode('?', $fields['previous_route']);
        $prev_route = $explode_prev_route[0];

        if(Auth::user()->is_super && (isset($fields['status_product']) && $fields['status_product'] === 'APPROVED')){
            if($prev_route === route('products.filter.dishes')){
                return redirect()->route('products.create.'.strtolower($fields['type']), ['restaurant'=>$product->restaurant->id])->with([
                    'notification' => trans('messages.notification.product_saved'),
                    'type-notification' => 'success'
                ]); 
            }
            return redirect()->route('products.create.'.strtolower($fields['type']))->with([
                'notification' => trans('messages.notification.product_saved'),
                'type-notification' => 'success'
            ]); 
        }

        if(Auth::user()->is_super && ($prev_route === route('products.filter.dishes'))){
            return redirect()->route('products.filter.dishes', ['restaurant'=>$product->restaurant->id, 'brand'=>$product->company->id])->with([
                'notification' => trans('messages.notification.product_saved'),
                'type-notification' => 'success'
            ]); 
        }

        return redirect()->route('products.index')->with([
            'notification' => trans('messages.notification.product_saved'),
            'type-notification' => 'success'
        ]);

    }

    public function filter(Request $request)
    {
        try{
            $fields = $request->all();
            $field_restaurant = $fields['restaurant_id'] ?? $fields['restaurant'];
            $field_brand = $fields['brand_id'] ?? $fields['brand'];
            $restaurant = Restaurant::where('id', $field_restaurant)->get();
            $brand = Company::where('id', $field_brand)->get();
            if (Auth::user()->is_super) {
                $products = Product::whereHas('restaurant', function ($query) use ($field_restaurant) {
                    $query->where('id', $field_restaurant);
                })
                ->orderBy('created_at', 'DESC')
                ->orderByRaw('FIELD(status_product, "PENDING","DRAFT","DISABLED","APPROVED")')
                ->get();
                return view('admin.products.index')->with([
                    'restaurant' => $restaurant,
                    'brand' => $brand,
                ])->with(compact('products'));
            }
        }
        catch (\Throwable $exception) {
            Log::info('An error occurred during capture payment {' . $exception . '}');
        }

    }


    public function destroy(Product $product)
    {
        $explode_prev_route = explode('?', url()->previous());
        $prev_route = $explode_prev_route[0];
        if ($product->pickupsAreExpired()) {
            if(Auth::user()->is_super && ($prev_route === route('products.filter.dishes'))){
                return redirect()->route('products.filter.dishes', ['restaurant'=>$product->restaurant->id, 'brand'=>$product->company->id])->with([
                    'notification' => trans('messages.notification.product_saved'),
                    'type-notification' => 'success'
                ]); 
            }
            return redirect()->route('products.index')->with([
                'notification' => trans('messages.notification.product_cant_remove'),
                'type-notification' => 'danger'
            ]);
        }

        $product->delete();
        if(Auth::user()->is_super && ($prev_route === route('products.filter.dishes'))){
            return redirect()->route('products.filter.dishes', ['restaurant'=>$product->restaurant->id, 'brand'=>$product->company->id])->with([
                'notification' => trans('messages.notification.product_saved'),
                'type-notification' => 'success'
            ]); 
        }
        return redirect()->route('products.index')->with([
            'notification' => trans('messages.notification.product_removed'),
            'type-notification' => 'warning'
        ]);

    }


    public function ajaxDestroy(Request $request)
    {

        $product = Product::find($request->product_id);

        if ($product->pickups->count() > 0) {
            return response()->json(['error' => trans('messages.product_in_pickup')], 200);
        }
        $product->section()->dissociate();
        $product->save();

        return response()->json(['id' => $request->product_id], 200);

    }

    public function setPosition(Product $product, Request $request)
    {

        $product->update(['position' => $request->position]);

        return $product;

    }


    public function saveCategories(Product $product, array $fields)
    {

        if ($fields['type'] == 'Drink') return;
        $list = array();

        $categoriesList = $this->getCategoriesId(@$fields['foods']);
        $allergensList = $this->getCategoriesId(@$fields['allergens']);
        $dietaryList = $this->getCategoriesId(@$fields['dietaries']);

        $categories = array_merge($categoriesList, $allergensList, $dietaryList);

        $product->categories()->sync($categories);

    }


    public function getCategoriesId($array)
    {

        $list = array();

        if (empty($array)) return array();

        foreach ($array as $key => $category) {

            $categoryModel = Category::whereHas('translate', function ($q) use ($category) {
                $q->where('name', $category);
            })->first();

            if ($categoryModel) {
                array_push($list, $categoryModel->id);
            }

        }

        return $list;

    }

}
