<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




    /* Index
    * Get standard fields for all list view 
    *
    *
    */
    public function index() {

          view()->composer('admin.components.datatable', function ($view) {

                $fields = $this->datatableFields;
                $route = \Route::getCurrentRoute()->uri;

                $view
                ->with([
                  'fields' => $fields,
                  'route'  => $route
                ]);

          });


    }
}
