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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user', 'UserController@getAuthenticatedUser');

    //PRODUCTS
    Route::get('products', 'ProductController@index');
    Route::get('products/{product}', 'ProductController@show');
    Route::post('products', 'ProductController@store');
    Route::put('products/{product}', 'ProductController@update');
    Route::delete('products/{product}', 'ProductController@delete');

    //PRODUCTOS DE ACUERDO A UN USUARIO
    Route::get('users/{user}/products', 'ProductController@index');
    Route::get('users/{user}/products/{product}', 'ProductController@show');
    Route::post('users/{user}/products', 'ProductController@store');
    Route::put('users/{user}/products/{product}', 'ProductController@update');
    Route::delete('users/{user}/products/{product}', 'ProductController@delete');

    //PRODUCTOS DE ACUERDO A UN CLIENTE
    Route::get('customers/{customer}/products', 'ProductController@index');
    Route::get('customers/{customer}/products/{product}', 'ProductController@show');
    Route::post('customers/{customer}/products', 'ProductController@store');
    Route::put('customers/{customer}/products/{product}', 'ProductController@update');
    Route::delete('customers/{customer}/products/{product}', 'ProductController@delete');

    //CUSTOMERS
    Route::get('customers', 'CustomerController@index');
    Route::get('customers/{customer}', 'CustomerController@show');
    Route::post('customers', 'CustomerController@store');
    Route::put('customers/{customer}', 'CustomerController@update');
    Route::delete('customers/{customer}', 'CustomerController@delete');

    //SUPPLIERS
    Route::get('suppliers', 'SupplierController@index');
    Route::get('suppliers/{supplier}', 'SupplierController@show');
    Route::post('suppliers', 'SupplierController@store');
    Route::put('suppliers/{supplier}', 'SupplierController@update');
    Route::delete('suppliers/{supplier}', 'SupplierController@delete');

});
