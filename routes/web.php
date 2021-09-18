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


Route::get('/', 'HomeController@index')->name('home');

Route::middleware('admin')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::resource('users', 'UserController')->names('user');
    Route::resource('categories', 'CategoryController')->names('category')->except('show');
    Route::resource('products', 'ProductController')->names('products')->except('show');
});
