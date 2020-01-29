<?php

namespace App\Providers;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Libraries\Sidebar;
use Spatie\BladeX\Facades\BladeX;
use App\Observers\IdentifierObserver;
use Ahc\Jwt\JWT;

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
            $media = \App\Models\Media::all();
            $view->with(compact('media'));
          });

        view()->composer('admin.products.parts.dish', function ($view) {
            $categories = \App\Models\Category::getCategoriesByType();
            $view->with(compact('categories'));
          });
        view()->composer('admin.products.parts.drink', function ($view) {
            $categories = \App\Models\Category::getCategoriesByType();
            $view->with(compact('categories'));
          });


          BladeX::component('admin.components.fields.*');
          BladeX::component('admin.components.*');

          \App\Models\Brand::observe(IdentifierObserver::class);
          \App\Models\Restaurant::observe(IdentifierObserver::class);
          \App\Models\Category::observe(IdentifierObserver::class);
          \App\Models\Menu::observe(IdentifierObserver::class);
          \App\Models\MenuSection::observe(IdentifierObserver::class);
          \App\Models\Product::observe(IdentifierObserver::class);
          \App\Models\Product::observe(\App\Observers\ProductObserver::class);
          \App\Models\ProductTranslation::observe(\App\Observers\ProductTranslationObserver::class);
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
