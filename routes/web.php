<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'auth'], function(){

  Route::get('/', 'DashboardController@index')->name('dashboard.index');
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
  Route::get('/blank', 'DashboardController@blank')->name('dashboard.blank');

/*
  Route::get('/list', function(){ return view('admin.blank');})->name('user.list');
  Route::get('/new', function(){ return view('admin.blank');})->name('user.new');
*/

  Route::resource('/brands', 'BrandController');
  Route::resource('/categories', 'CategoryController');
  Route::resource('/users', 'UserController');
  Route::resource('/restaurants', 'RestaurantController');

  Route::get('/brands/{brand}/restaurants', 'RestaurantController@index')->name('brand.restaurants.index');
  Route::get('/brands/{brand}/restaurants{restaurant}', 'RestaurantController@view')->name('brand.restaurants.view');
  Route::post('/brands/{brand}/restaurants', 'RestaurantController@store')->name('brand.restaurants.store');
  Route::get('/brands/{brand}/restaurants/create', 'RestaurantController@create')->name('brand.restaurants.create');
  Route::put('/brands/{brand}/restaurants/{restaurant}', 'RestaurantController@update')->name('brand.restaurants.update');


  Route::resource('/media', 'MediaController', ['parameters' => ['media' => 'media']]); //force 'media' name because laravel will set automatic to 'medium'



});

Auth::routes();
