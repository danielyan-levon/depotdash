<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');
Route::get('/settings/addresses', 'AddressBookController@all');
Route::put('/settings/address-book', 'AddressBookController@create');
Route::put('/settings/address/{address_id}', 'AddressBookController@update');
Route::delete('/settings/address/{address_id}', 'AddressBookController@destroy');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'admin']], function() {
    // Route::get('/', 'AdminController@index');
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/customers', 'CustomerController@index');
    Route::resource('administrators', 'AdminController');
    Route::resource('customer', 'CustomerController');
//    Route::get('/account-admins', 'AdminController@create');
});

Route::group(['middleware' => ['web']], function () {

    /* Start Admin routes */
    Route::get('/admin', 'Admin\DashboardController@index')->middleware('admin');
    Route::get('/admin/login', 'Admin\Auth\AuthController@showLoginForm')->name('admin-login');
    Route::post('/admin/login', 'Admin\Auth\AuthController@login')->name('admin-login');
    Route::get('/admin/logout', 'Admin\Auth\AuthController@logout')->name('admin-logout');
    /* End Admin routes */
});

// Test
Route::get('/test', 'TestController@index');
