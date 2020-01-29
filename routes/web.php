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

Route::get('/','LandingController@index');


 Route::prefix('admin')->group(function () {

    Route::get('login', 'Auth\LoginController@index')->name('login')->middleware('guest');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('login', 'Auth\LoginController@login')->name('authenticate');
    Route::get('set-password', 'Auth\LoginController@setPassword')->name('password.set');
    Route::post('confirm-password', 'Auth\LoginController@confirmPassword')->name('password.confirm');

    Route::group(['middleware' => ['auth', 'user.roles']], function(){

        Route::get('/', 'DashboardController@index')->name('dashboard.index');

        Route::get('blank', 'DashboardController@blank')->name('dashboard.blank');

        Route::get('profile', 'UserController@me')->name('users.profile');

        Route::post('/file/upload', 'UploadFileController@upload')->name('file.upload');

        Route::resource('/brands', 'BrandController');
        Route::resource('/menu', 'MenuController');

        Route::post('/menu/section/{menu}', 'MenuSectionController@save')->name('menu.section.save');
        Route::put('/menu/section/{menu}', 'MenuSectionController@update')->name('menu.section.update');
        Route::delete('/section/ajaxDelete', 'MenuSectionController@destroy')->name('menu.section.destroy');
        Route::post('/section/position/{section}', 'MenuSectionController@setPosition')->name('section.position');
        Route::post('/section/product/add', 'MenuSectionController@addProduct')->name('section.product.add');

        Route::resource('/products', 'ProductController');
        Route::get('/products/create/dish', 'ProductController@create')->name('products.create.dish');
        Route::get('/products/create/drink', 'ProductController@create')->name('products.create.drink');


        Route::post('/products/position/{product}', 'ProductController@setPosition')->name('product.position');
        Route::delete('/section/products/ajaxDestroy', 'ProductController@ajaxDestroy')->name('product.ajax.destroy');


        Route::resource('/categories', 'CategoryController');
        Route::resource('/users', 'UserController');
        Route::resource('/restaurants', 'RestaurantController');

        Route::get('/brands/{brand}/restaurants', 'RestaurantController@index')->name('brand.restaurants.index');
        Route::get('/brands/{brand}/restaurants{restaurant}', 'RestaurantController@view')->name('brand.restaurants.view');
        Route::post('/brands/{brand}/restaurants', 'RestaurantController@store')->name('brand.restaurants.store');
        Route::get('/brands/{brand}/restaurants/create', 'RestaurantController@create')->name('brand.restaurants.create');
        Route::put('/brands/{brand}/restaurants/{restaurant}', 'RestaurantController@update')->name('brand.restaurants.update');

        Route::get('/restaurants/data/{brand?}', 'RestaurantController@data')->name('brand.restaurants.data');

        Route::resource('/media', 'MediaController', ['parameters' => ['media' => 'media']]); //force 'media' name because laravel will set automatic to 'medium'

    });
});

Route::get('/media/image/{file}','MediaController@viewImageData');

//Auth::routes();
