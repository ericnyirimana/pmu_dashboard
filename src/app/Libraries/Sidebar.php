<?php

namespace App\Libraries;

use Route;

class Sidebar
{
    /**
     * Fill the array of routes to be used in the sidebar view
     *
     * @return array
     */
    public static function getAdminRoutes()
    {
        $routes = config('menu.admin');


        foreach ($routes as $menuName => &$menuInfo) {
            foreach ($menuInfo['routes'] as $routeName => $routePath) {
                if (!isset($menuInfo['active']) || !$menuInfo['active']) {
                    $currentRouteParts = explode('.', Route::current()->getName());
                    $routePathParts = explode('.', $routePath);

                    $menuInfo['active'] = $currentRouteParts[1] == $routePathParts[1];
                }
            }
        }

        return $routes;
    }

    /**
     * Get the logged Operator
     *
     * @return array
     */
    public static function getAdminOperator()
    {
        #return auth()->guard('admin')->user();
    }
}
