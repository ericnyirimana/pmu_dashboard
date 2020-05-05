<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use App\Traits\TranslationTrait;

use Auth;

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

        if (Auth::user()->is_super) {
            $products = Product::all();

        } else {
            $products = Auth::user()->brand->first()->products;
        }

        return view('admin.products.index')
            ->with(compact('products'));


    }


    public function create()
    {

        $route = \Request::route()->getName();
        $arrRoute = explode('.', $route);

        $product = new Product();
        $product->type = ucfirst(end($arrRoute));

        if (Auth::user()->is_super) {
            $companies = Company::all();

        } else {
            $companies = Auth::user()->brand->first();
        }

        $foods = Category::where('type', 'Food')->with('translate')->get()->pluck('translate.name');
        $allergens = Category::where('type', 'Allergen')->with('translate')->get()->pluck('translate.name');
        $dietaries = Category::where('type', 'Dietary')->with('translate')->get()->pluck('translate.name');

        return view('admin.products.create')->with([
                'product' => $product,
                'companies' => $companies,
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

        $fields['type'] = $request->type ?? 'Dish';
        $fields['status'] = $request->status ?? false;

        $product = Product::create($fields);

        $this->saveTranslation($product, $fields);

        $this->saveCategories($product, $fields);

        if ($request->media) {
            $product->media()->sync(array_unique($request->media));
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
            $companies = Auth::user()->company;
        }

        $foods = Category::where('type', 'Food')->with('translate')->get()->pluck('translate.name');
        $allergens = Category::where('type', 'Allergen')->with('translate')->get()->pluck('translate.name');
        $dietaries = Category::where('type', 'Dietary')->with('translate')->get()->pluck('translate.name');


        return view('admin.products.edit')->with([
                'product' => $product,
                'companies' => $companies,
                'foods' => $foods,
                'allergens' => $allergens,
                'dietaries' => $dietaries
            ]
        );

    }

    public function update(Request $request, Product $product)
    {

        $this->validation($request, $product);

        $fields = $request->all();

        // if products is only updated set to DRAFT status
        if (!isset($fields['status_product'])) {
            $fields['status_product'] = 'DRAFT';
        }
        $this->saveCategories($product, $fields);

        $product->update($fields);

        $this->saveTranslation($product, $fields);


        if ($request->media) {
            $product->media()->sync(array_unique($request->media));
        }


        return redirect()->route('products.index')->with([
            'notification' => trans('messages.notification.product_saved'),
            'type-notification' => 'success'
        ]);

    }


    public function destroy(Product $product)
    {

        $product->delete();

        return redirect()->route('products.index')->with([
            'notification' => trans('messages.notification.product_removed'),
            'type-notification' => 'warning'
        ]);

    }

    public function softDelete(Product $product)
    {

        $product->withTrashed()->get();

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
