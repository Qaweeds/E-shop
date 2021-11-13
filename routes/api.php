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
Route::namespace('Api')->group(function () {
    Route::post('login', 'LoginController');

    Route::namespace('v1')->prefix('v1')->group(function () {
        Route::get('products', 'ProductController@index');
        Route::get('products/{product}', 'ProductController@show');

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('category/list', 'CategoryController@list');

            Route::middleware('admin.api')->group(function () {
                Route::post('category/create', 'CategoryController@create');
            });
        });
    });


});

