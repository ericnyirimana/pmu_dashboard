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
if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', 'LandingController@index');
/*
Route::prefix('/')->group(function () {

    Route::group(['middleware' => ['auth', 'user.roles']], function () {

        Route::get('/', 'DashboardController@index')->name('dashboard.index');
    });
});
*/
Route::prefix('admin')->group(function () {

    Route::group(['middleware' => ['auth', 'user.roles']], function () {

        Route::get('/', 'DashboardController@index')->name('dashboard.index');

        // Route::get('blank', 'DashboardController@blank')->name('dashboard.blank');

        Route::get('profile', 'UserController@me')->name('users.profile');

        Route::post('/file/upload', 'UploadFileController@upload')->name('file.upload');


        Route::resource('/menu', 'MenuController');

        Route::post('/menu/section/{menu}', 'MenuSectionController@save')->name('menu.section.save');
        Route::put('/menu/section/{menu}', 'MenuSectionController@update')->name('menu.section.update');
        Route::delete('/section/ajaxDelete', 'MenuSectionController@destroy')->name('menu.section.destroy');
        Route::post('/section/position/{section?}', 'MenuSectionController@setPosition')->name('section.position');
        Route::post('/section/product/add', 'MenuSectionController@addProduct')->name('section.product.add');

        Route::get('/products/filter', 'ProductController@filter')->name('products.filter.dishes');
        Route::resource('/products', 'ProductController');
        Route::get('/products/create/dish', 'ProductController@create')->name('products.create.dish');
        Route::get('/products/create/drink', 'ProductController@create')->name('products.create.drink');
        Route::post('/products/position/{product}', 'ProductController@setPosition')->name('product.position');
        Route::delete('/section/products/ajaxDestroy', 'ProductController@ajaxDestroy')->name('product.ajax.destroy');

        Route::get('/pickups/calendar', 'PickupController@calendar')->name('pickups.calendar');
        Route::resource('/pickups', 'PickupController');
        Route::get('/pickups/{pickup}/replicate', 'PickupController@replicate')->name('pickups.replicate');

        Route::resource('/mealtypes', 'MealTypeController');

        Route::resource('/timeslots', 'TimeslotController');

        Route::resource('/showcases', 'ShowcaseController');

        Route::resource('/categories', 'CategoryController');
        Route::resource('/users', 'UserController');
        Route::resource('/restaurants', 'RestaurantController');
        Route::post('/integrations/{restaurant}', 'RestaurantController@saveIntegration')->name('restaurant.set.integration');
        Route::get('/payments', 'RestaurantController@payment')->name('payments.show');

        Route::resource('/orders', 'OrderController');

        Route::resource('/orders-pickup', 'OrderPickupController');

        Route::get('/subscriptions/{id}', 'PickupSubscriptionController@show')->name('subscriptions.show');

        Route::resource('/companies', 'CompanyController');

        Route::post('/companies/{company}/restaurants', 'RestaurantController@store')->name('company.restaurants.store');
        Route::get('/companies/{company}/restaurants/create', 'RestaurantController@create')->name('company.restaurants.create');
        Route::put('/companies/{company}/restaurants/{restaurant}', 'RestaurantController@update')->name('company.restaurants.update');

        Route::get('/restaurants/data/{company?}', 'RestaurantController@data')->name('company.restaurants.data');

        Route::get('/timeslots/data/{restaurant?}', 'TimeslotController@data')->name('restaurant.timeslots.data');


        Route::resource('/media', 'MediaController', ['parameters' => ['media' => 'media']]); //force 'media' name because laravel will set automatic to 'medium'
        Route::get('/media/approve/{media?}', 'MediaController@approve')->name('media.approve');
        Route::get('/media/pending/{media?}', 'MediaController@pending')->name('media.pending');

        Route::get('/medias/image/{media}', 'MediaController@viewImageData');

        Route::get('/company/data/{company?}', 'CompanyController@data')->name('company.data');

        Route::get('/tickets/{ticket}', 'TicketController@show')->name('ticket.show');
        Route::put('/tickets/{ticket}', 'TicketController@cancelTicketsById')->name('ticket.update');
        Route::post('/orders/close', 'OrderController@closeOrder')->name('close.order');
        Route::put('/order-ticket/close/{id?}', 'OrderPickupController@closeTicket')->name('close.ticket');
        Route::get('/filter/orders', 'OrderController@filtering')->name('filtering-orders.data');
        Route::get('/order-ticket/count/uncanceled/{order?}', 'OrderPickupController@countUnCanceledTicket')->name('count.uncanceled.ticket');
        Route::get('/pickups/today/ordered-product/{pickup?}/{product?}', 'PickupController@isProductOrdered')->name('today.ordered.product');
        Route::get('/pickups/today/ordered-menu/{pickup?}/{menu_section_id?}', 'PickupController@isMenuOrdered')->name('today.ordered.menu');
        Route::resource('/loyalty-card', 'LoyaltyCardController');
        Route::get('/subscriptions', 'PickupSubscriptionController@index')->name('subscriptions.index');
        Route::get('/subscriptions/order/detail/{order_id?}/{pickup_id?}', 'PickupSubscriptionController@detail')->name('subscriptions.detail');
        Route::get('/subscriptions/pickup/filter', 'PickupSubscriptionController@filtering')->name('filtering-pickup-subscription.data');

        if (env('APP_DEBUG')) {
            \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
                \Illuminate\Support\Facades\Log::info( json_encode($query->sql) );
                \Illuminate\Support\Facades\Log::info( json_encode($query->bindings) );
                \Illuminate\Support\Facades\Log::info( json_encode($query->time)   );
            });
        }
    });

    Route::post('login', 'Auth\LoginController@login')->name('authenticate');
    Route::get('login', 'Auth\LoginController@index')->name('login')->middleware('guest');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('set-password', 'Auth\LoginController@setPassword')->name('password.set');
    Route::post('confirm-password', 'Auth\LoginController@confirmPassword')->name('password.confirm');
    Route::get('forgot-password', 'Auth\ForgotPasswordController@index')->name('forgot.password');
    Route::post('password-reset-link', 'Auth\ForgotPasswordController@sendResetLinkPassword')->name('send.reset.link');
    Route::get('password-reset/', 'Auth\ForgotPasswordController@resetPassword')->name('reset.password');
    Route::post('confirm-password-reset', 'Auth\ForgotPasswordController@confirmResetPassword')->name('confirm.reset.password');
});



//Auth::routes();
