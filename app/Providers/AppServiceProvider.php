<?php

namespace App\Providers;

use App\Libraries\Sidebar;
use App\Models\Media;
use App\Models\Menu;
use App\Models\OrderPickup;
use App\Models\Pickup;
use App\Models\Product;
use App\Observers\IdentifierObserver;
use Auth;
use Carbon\Carbon;
use Cookie;
use function foo\func;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\BladeX\Facades\BladeX;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);


        view()->composer('admin.layouts.topbar', function ($view) {
            $notifications = [];
            $totalNotifications = 0;
            if (Auth::user()->is_super) {
                $totMediaToApprove = Media::where('status_media', '!=', 'APPROVE')->get()->count();
                $totProductsToApprove = Product::where('status_product', '!=', 'APPROVED')->get()->count();
                $totMenusToApprove = Menu::where('status_menu', '!=', 'APPROVED')->get()->count();

                $totalNotifications = $totMediaToApprove + $totProductsToApprove + $totMenusToApprove;

                $notifications = [
                    'totMediaToApprove' => $totMediaToApprove,
                    'totProductsToApprove' => $totProductsToApprove,
                    'totMenusToApprove' => $totMenusToApprove
                ];
            } else if (Auth::user()->is_manager) {
                Auth::user()->restaurant->map(function ($restaurant) use (&$totalNotifications){
                    $pickupsId = Pickup::where('restaurant_id', $restaurant->id)->pluck('id');
                    $orderPickups = OrderPickup::whereIn('pickup_id', $pickupsId)->get();
                    $orderToNotify = $orderPickups->filter(function ($item) {
                        if (Carbon::parse(Auth::user()->previous_login)->lte(Carbon::parse($item->order->created_at))) {
                            return $item;
                        }
                    });
                    $totalNotifications += $orderToNotify->count();
                });
            }


            $view->with(compact('totalNotifications'))
                ->with(compact('notifications'));
        });

        view()->composer('admin.layouts.sidebar', function ($view) {
            $routes = Sidebar::getAdminRoutes();
            $view->with(compact('routes'));
        });

        view()->composer('admin.layouts.crumber', function ($view) {
            $restaurants = [];
            if (Auth::user()->is_owner && Route::currentRouteName() == 'dashboard.index') {
                $restaurants = Auth::user()->restaurant->pluck('name', 'id')->toArray();
            }
            $routeName = \Route::current()->getName();
            $crumber = explode('.', $routeName);
            $view->with(compact('crumber'))
                ->with(compact('restaurants'));
        });

        view()->composer('admin.media.parts.modal-media', function ($view) {

            if (Auth::user()->is_super) {
                $media = \App\Models\Media::all();
                $brands = \App\Models\Company::all();
            } else {
                if (Auth::user()->is_owner) {
                    $mediaCompany = \App\Models\Media::where('brand_id', Auth::user()->brand->first()->id)->get();
                } else if (Auth::user()->is_restaurant) {
                    $mediaCompany = \App\Models\Media::where('restaurant_id', Auth::user()->restaurant->first()->id)->get();
                }

                $media = $mediaCompany;

                $brands = Auth::user()->brand;

            }

            $view->with(compact('media'))
                ->with(compact('brands'));
        });


        view()->composer('components.company-restaurant-select', function ($view) {

            if (Auth::user()->is_super) {
                $companies = \App\Models\Company::all();
                $restaurants = \App\Models\Restaurant::all();
            } else {
                $companies = Auth::user()->brand->first();
                $restaurants = Auth::user()->restaurant;
            }

            $view->with([
                'companies' => $companies,
                'restaurants' => $restaurants
            ]);
        });


        BladeX::component('components.fields.*');
        BladeX::component('components.*');

        \App\Models\Company::observe(IdentifierObserver::class);
        \App\Models\Restaurant::observe(IdentifierObserver::class);
        \App\Models\Category::observe(IdentifierObserver::class);
        \App\Models\Menu::observe(IdentifierObserver::class);
        \App\Models\MenuSection::observe(IdentifierObserver::class);
        \App\Models\Product::observe(IdentifierObserver::class);
        \App\Models\Pickup::observe(IdentifierObserver::class);
        \App\Models\Order::observe(IdentifierObserver::class);
        \App\Models\Timeslot::observe(IdentifierObserver::class);
        \App\Models\Showcase::observe(IdentifierObserver::class);

        \App\Models\Product::observe(\App\Observers\ProductObserver::class);
        \App\Models\ProductTranslation::observe(\App\Observers\ProductTranslationObserver::class);
        \App\Models\Media::observe(\App\Observers\MediaObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}
