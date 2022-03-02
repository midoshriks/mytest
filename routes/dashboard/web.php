<?php
// use Illuminate\Routing\Route;

use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Route;

Route::post('/importexcel', 'CategoryController@importexcel');

Route::group(['prefix' => 'LaravelLocalization'::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'WelcomeController@index')->name('welcome');

            //category routes
            Route::resource('categories', 'CategoryController')->except(['show']);
            Route::get('/export', 'CategoryController@export')->name('export');


            //product routes
            Route::resource('products', 'ProductController')->except(['show']);

            //client routes
            Route::resource('clients', 'ClientController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrderController')->except(['show']);

            //order routes
            Route::resource('orders', 'OrderController');
            Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');


            //user routes
            Route::resource('users', 'UserController')->except(['show']);

        });//end of dashboard routes
    });


