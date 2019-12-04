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


Route::get('/cognito', 'UserController@cognito');
Route::group(['middleware' => 'auth'], function(){

  Route::get('/', 'DashboardController@index')->name('dashboard.index');
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
  Route::get('/blank', 'DashboardController@blank')->name('dashboard.blank');

/*
  Route::get('/list', function(){ return view('admin.blank');})->name('user.list');
  Route::get('/new', function(){ return view('admin.blank');})->name('user.new');
*/

  Route::resource('/brands', 'BrandController');
  Route::resource('/users', 'UserController');
  Route::resource('/restaurants', 'RestaurantController');


  Route::resource('/media', 'MediaController', ['parameters' => ['media' => 'media']]); //force 'media' name because laravel will set automatic to 'medium'



});

Auth::routes();
