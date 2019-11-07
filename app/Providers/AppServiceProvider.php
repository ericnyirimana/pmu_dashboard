<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Libraries\Sidebar;

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

      view()->composer('admin.layouts.header', function ($view) {
            #$operator = auth()->guard('admin')->user();
            #$view->with(compact('operator'));
        });

      view()->composer('admin.layouts.sidebar', function ($view) {
          $routes = Sidebar::getAdminRoutes();

          $view->with(compact('routes'));
        });

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
