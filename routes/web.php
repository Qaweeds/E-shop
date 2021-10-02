<?php

use Illuminate\Support\Facades\Route;

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
\Illuminate\Support\Facades\Auth::routes();

Route::get('/', 'HomeController')->name('home');

Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/products/{product}', 'ProductController@show')->name('product.show');

Route::get('/categories', 'CategoryController@index')->name('category.index');
Route::get('/categories/{category}', 'CategoryController@show')->name('category.show');


Route::delete('/ajax-product-image-delete/{id}', 'ProductImageController@productImageDelete')->name('ajax.product.image.delete');

Route::middleware('auth')->namespace('Account')->prefix('account')->group(function () {
    Route::get('/', 'AccountController@index')->name('account.index');
    Route::get('/edit/{id}', 'AccountController@edit')->middleware('can:update,user')->name('account.edit');
    Route::post('/update', 'AccountController@update')->middleware('can:update,user')->name('account.update');
});
Route::middleware(['auth', 'admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'BaseController')->name('admin.index');

    Route::prefix('orders')->group(function () {
        Route::get('/', 'OrderController@index')->name('orders.index');
        Route::get('/{order}', 'OrderController@show')->name('orders.show');
    });

    Route::resource('users', 'UserController')->names('users');
    Route::resource('categories', 'CategoryController')->names('categories')->except(['show', 'destroy']);
    Route::resource('products', 'ProductController')->names('products')->except('show');

});

Route::middleware('auth')->group(function () {
    Route::get('cart', 'CartController@index')->name('cart.index');
    Route::post('cart/{product}/add', 'CartController@add')->name('cart.add');
    Route::post('cart/{product}/count/update', 'CartController@productCountUpdate')->name('cart.count_update');
    Route::delete('cart/delete', 'CartController@delete')->name('cart.delete');

    Route::post('order', 'OrderController@store')->name('order.store');
    Route::get('checkout', 'CheckoutController')->name('checkout');
});
