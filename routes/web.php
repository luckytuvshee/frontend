<?php

use Illuminate\Support\Facades\Route;
use App\DataTables\ReportDataTable;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::resource('/products', 'ProductController');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::group(['prefix' => 'dashboard'], function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    // place / after /login because / will be caught before these.

    Route::get('/chart', 'AdminController@charts')->name('charts');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    
    
    Route::group(['prefix' => 'products', 'middleware' => 'can:see-product'], function() {
        Route::get('/', 'ProductController@index')->name('products');
        Route::post('/', 'ProductController@store')->name('product.store');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::get('/{id}', 'ProductController@show')->name('product.show');
        Route::post('/{id}', 'ProductController@update')->name('product.update');
        Route::delete('/delete', 'ProductController@destroy')->name('product.delete');
        Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('can:edit-product');
    });

    Route::group(['prefix' => 'product-registration', 'middleware' => 'can:see-product'], function() {
        Route::post('/fetch', 'ProductRegistrationController@fetch')->name('product.registration.fetch');
        Route::get('/', 'ProductRegistrationController@index')->name('product.registration');
        Route::post('/', 'ProductRegistrationController@store')->name('product.registration.store');
        Route::get('/{id}', 'ProductRegistrationController@show')->name('product.registration.show');
        Route::post('/{id}', 'ProductRegistrationController@update')->name('product.registration.update');
        Route::delete('/delete', 'ProductRegistrationController@destroy')->name('product.registration.delete');
        Route::get('/edit/{id}', 'ProductRegistrationController@edit')->name('product.registration.edit');
        Route::get('/create/{id}', 'ProductRegistrationController@create')->name('product.registration.create')
                                                                      ->middleware('can:edit-product');
    });

    Route::group(['prefix' => 'profile'], function() {
        Route::get('/', 'EmployeeController@show_profile')->name('employee.profile.index');
        Route::get('/edit', 'EmployeeController@edit_profile')->name('employee.profile.edit');
        Route::post('/edit', 'EmployeeController@update_profile')->name('employee.profile.update');
    });

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UserController@index')->name('users')->middleware('can:see-users');
        Route::get('/{id}', 'UserController@show')->name('user.show')->middleware('can:see-users');
        Route::post('/{id}', 'UserController@update')->name('user.update')->middleware('can:alter-users');
        Route::get('/delete/{id}', 'UserController@destroy')->name('user.delete')->middleware('can:alter-users');
        Route::get('/edit/{id}', 'UserController@edit')->name('user.edit')->middleware('can:alter-users');
    });

    Route::group(['prefix' => 'baskets'], function() {
        Route::get('/', 'BasketController@index')->name('baskets')->middleware('can:see-baskets');
        Route::get('/item/{id}', 'BasketController@show')->name('basket.show')->middleware('can:see-baskets');
    });

    Route::group(['prefix' => 'employees', 'middleware' => 'can:anything-employees'], function() {
        Route::get('/', 'EmployeeController@index')->name('employees');
        Route::post('/', 'EmployeeController@store')->name('employee.store');
        Route::get('/create', 'EmployeeController@create')->name('employee.create');
        Route::get('/{id}', 'EmployeeController@show')->name('employee.show');
        Route::post('/{id}', 'EmployeeController@update')->name('employee.update');
        Route::get('/delete/{id}', 'EmployeeController@destroy')->name('employee.delete');
        Route::get('/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
    });

    Route::group(['prefix' => 'orders'], function() {
        Route::get('/', 'OrderController@index')->name('orders');
        Route::get('/shipped/{id}', 'OrderController@shipped')->name('order.shipped');
        Route::get('/shipping-started/{id}', 'OrderController@shipping_started')->name('order.shipping_started');
        Route::get('/assign/{id}', 'OrderController@assign')->name('order.assign');
        Route::post('/assign/{id}', 'OrderController@assign_order')->name('order.assign_order');
        Route::get('/package/{id}', 'OrderController@package')->name('order.package');
        Route::post('/package/{id}', 'OrderController@package_order')->name('order.package_order');
    });

    Route::group(['prefix' => 'address', 'middleware' => 'can:anything-address'], function() {
        Route::get('/', 'AddressController@index')->name('cities');
        // add city
        Route::post('/', 'AddressController@city_add')->name('city.add');
        // delete city
        // Route::get('/delete/{id}', 'AddressController@city_delete')->name('city.delete');
        Route::delete('/delete', 'AddressController@city_delete')->name('city.delete');


        Route::get('/{id}/districts', 'AddressController@districts')->name('districts');
        // add district
        Route::post('/{id}/districts', 'AddressController@district_add')->name('district.add');
        // get subdistricts
        Route::get('/{id}/subdistricts', 'AddressController@subdistricts')->name('subdistricts');
        // add subdistrict
        Route::post('/{id}/subdistricts', 'AddressController@subdistrict_add')->name('subdistrict.add');

        // delete district
        Route::delete('/delete/districts', 'AddressController@district_delete')->name('district.delete');
        // delete subdistrict
        Route::delete('/delete/subdistricts', 'AddressController@subdistrict_delete')->name('subdistrict.delete');

        // city update
        Route::post('/update', 'AddressController@city_update')->name('city.edit');
        // district update
        Route::post('/district/update', 'AddressController@district_update')->name('district.edit');
        // subdistrict update
        Route::post('/subdistrict/update', 'AddressController@subdistrict_update')->name('subdistrict.edit');
    });

    Route::group(['prefix' => 'shipments', 'middleware' => 'can:anything-shipments'], function() {
        Route::get('/', 'ShipmentController@index')->name('shipments');
    });

    Route::group(['prefix' => 'reports', 'middleware' => 'can:see-reports'], function() {
        Route::get('/packaging-report', 'ReportController@packaging_report')->name('report.packaging');
        Route::get('/shipment-report', 'ReportController@shipment_report')->name('report.shipment');
    });
});

