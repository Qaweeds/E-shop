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

Route::middleware('auth')->namespace('Account')->prefix('account')->group(function () {
    Route::get('/', 'AccountController@index')->name('account.index');
    Route::get('/edit', 'AccountController@edit')->name('account.edit');
    Route::post('/update', 'AccountController@update')->name('account.update');
});

Route::middleware('admin')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::resource('users', 'UserController')->names('users');
    Route::resource('categories', 'CategoryController')->names('categories')->except(['show','destroy']);
    Route::resource('products', 'ProductController')->names('products')->except('show');
});
