<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version(['v1'], function() use ($api) {

    $api->group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\api\v1'], function($api) {

      $api->get('ping', 'PingController@ping');
      $api->get('pong', 'PingController@pong');

    });
});
