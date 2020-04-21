<?php

namespace App\Providers;

use App\Libraries\Sidebar;
use App\Observers\IdentifierObserver;
use Auth;
use Cookie;
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



        view()->composer('admin.layouts.sidebar', function ($view) {
            $routes = Sidebar::getAdminRoutes();
            $view->with(compact('routes'));
          });

        view()->composer('admin.layouts.crumber', function ($view) {
            $routeName =  \Route::current()->getName();
            $crumber = explode('.', $routeName);
            $view->with(compact('crumber'));
          });

        view()->composer('admin.media.parts.modal-media', function ($view) {

            if (Auth::user()->is_super) {
                $media = \App\Models\Media::all();
            } else {
                $mediaAll = \App\Models\Media::whereNull('brand_id')->get();
                $mediaCompany = \App\Models\Media::where('brand_id', Auth::user()->company->id)->get();

                $media = $mediaAll->merge($mediaCompany);
            }

            $view->with(compact('media'));
          });


          view()->composer('components.company-restaurant-select', function ($view) {

            if (Auth::user()->is_super) {
              $companies = \App\Models\Company::all();
              $restaurants = \App\Models\Restaurant::all();
            } else {
              $companies = Auth::user()->company;
              $restaurants = Auth::user()->company->restaurants;
            }

              $view->with([
                'companies'      => $companies,
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
