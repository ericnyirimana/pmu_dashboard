<?php

namespace App\Providers;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Libraries\Sidebar;
use Spatie\BladeX\Facades\BladeX;
use App\Observers\IdentifierObserver;
use Ahc\Jwt\JWT;
use Auth;
use Cookie;


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



        view()->composer('admin.layouts.sidebar', function ($view) {
            $routes = Sidebar::getAdminRoutes();
            $view->with(compact('routes'));
          });

        view()->composer('admin.layouts.crumber', function ($view) {
            $routeName = \Route::current()->getName();
            $crumber = explode('.', $routeName);

            $view->with(compact('crumber'));
          });

        view()->composer('admin.media.parts.modal-media', function ($view) {

            if (Auth::user()->is_super) {
                $media = \App\Models\Media::all();
            } else {
                $mediaAll = \App\Models\Media::whereNull('brand_id')->get();
                $mediaBrand = \App\Models\Media::where('brand_id', Auth::user()->brand->id)->get();

                $media = $mediaAll->merge($mediaBrand);
            }

            $view->with(compact('media'));
          });


          view()->composer('components.brand-restaurant-select', function ($view) {

            if (Auth::user()->is_super) {
              $brands = \App\Models\Brand::all();
              $restaurants = \App\Models\Restaurant::all();
            } else {
              $brands = Auth::user()->brand;
              $restaurants = Auth::user()->brand->restaurants;
            }

              $view->with([
                'brands'      => $brands,
                'restaurants' => $restaurants
              ]);
            });


          BladeX::component('components.fields.*');
          BladeX::component('components.*');

          \App\Models\Brand::observe(IdentifierObserver::class);
          \App\Models\Restaurant::observe(IdentifierObserver::class);
          \App\Models\Category::observe(IdentifierObserver::class);
          \App\Models\Menu::observe(IdentifierObserver::class);
          \App\Models\MenuSection::observe(IdentifierObserver::class);
          \App\Models\Product::observe(IdentifierObserver::class);
          \App\Models\PickupOffer::observe(IdentifierObserver::class);
          \App\Models\PickupSubscription::observe(IdentifierObserver::class);
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
