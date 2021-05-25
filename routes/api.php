<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/auth', [
    'as'   => 'login.load',
    'uses' => 'Api\Auth\LoginController@load_user'
]);

Route::post('/auth/register', [
    'as'   => 'register',
    'uses' => 'Api\Auth\RegisterController@register'
]);

Route::post('/auth/{id}', 'Api\Auth\LoginController@update')->name('user.update');

Route::post('/auth', [
    'as'   => 'login.login',
    'uses' => 'Api\Auth\LoginController@login'
]);



// Products

Route::get('/products', 'Api\ProductController@index')->name('products.index');
Route::get('/products/most-purchased', 'Api\ProductController@most_purchased')->name('products.most_purchased');
Route::get('/products/popular', 'Api\ProductController@popular')->name('products.popular');
Route::post('/products/search', 'Api\ProductController@search')->name('products.search');
Route::get('/products/{id}', 'Api\ProductController@show')->name('products.show');
Route::get('/products/like/{id}', 'Api\ProductController@similar')->name('products.similar');

// Product Types
Route::get('/product/types', [
    'as'   => 'products.types',
    'uses' => 'Api\ProductController@product_types'
]);

// Product Brands
Route::get('/product/brands', [
    'as'   => 'products.brands',
    'uses' => 'Api\ProductController@product_brands'
]);

// Type Product
Route::get('/products/type/{id}', [
    'as'   => 'product.types',
    'uses' => 'Api\ProductController@type_products'
]);

// Type Group Product
Route::get('/products/type/group/{id}', [
    'as'   => 'product.type_groups',
    'uses' => 'Api\ProductController@type_group_products'
]);

// Brand Products
Route::get('/products/brand/{id}', [
    'as'   => 'product.brands',
    'uses' => 'Api\ProductController@brand_products'
]);

// Profile
Route::get('/profile/liked/{user_id}', [
    'as'   => 'products.liked',
    'uses' => 'Api\ProductController@liked_products'
]);

Route::post('/profile/liked', [
    'as'   => 'products.liked.add',
    'uses' => 'Api\ProductController@add_liked'
]);

Route::post('/profile/unliked', [
    'as'   => 'products.liked.remove',
    'uses' => 'Api\ProductController@remove_liked'
]);

// Basket
Route::post('/baskets', 'Api\BasketController@store')->name('basketItems.store');
Route::get('/basket/product/{id}', 'Api\BasketController@show')->name('basketItems.show');
Route::get('/baskets/{user_id}', 'Api\BasketController@index')->name('basketItems');
Route::post('/basket/change/{item_id}', 'Api\BasketController@update')->name('basketItems.update');
Route::delete('/basket/delete/{item_id}', 'Api\BasketController@delete')->name('basketItems.delete');

// Fetch All Address
Route::get('/address', 'Api\AddressController@index')->name('addresses');

// User Created Address
Route::get('/address/{id}', 'Api\AddressController@user_addresses')->name('address.user');
// Add User Address
Route::post('/address', 'Api\AddressController@store')->name('address.store');
// Update User Address
Route::post('/address/{id}', 'Api\AddressController@update')->name('address.update');
// Delete User Address
Route::delete('/address/{id}', 'Api\AddressController@destroy')->name('address.delete');

// Add Order
Route::get('/orders/{id}', 'Api\OrderController@index')->name('order.index');
Route::post('/orders', 'Api\OrderController@store')->name('order.store');
Route::post('/orders/guest', 'Api\OrderController@guest_store')->name('order.guest.store');
Route::post('/orders/instant', 'Api\OrderController@instant_store')->name('order.instant_store');