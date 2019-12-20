<?php

namespace App\Providers;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Libraries\Sidebar;
use Spatie\BladeX\Facades\BladeX;
use App\Models\Brand;
use App\Models\Restaurant;
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


          BladeX::component('admin.components.fields.*');
          BladeX::component('admin.components.*');

          Brand::observe(IdentifierObserver::class);
          Restaurant::observe(IdentifierObserver::class);
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
