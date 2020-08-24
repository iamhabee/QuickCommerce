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

Route::group(['prefix' => 'auth'], function () {
    // authentication api 
    Route::post('register', 'Api\auth\RegisterController@register');
    Route::post('login', 'Api\auth\LoginController@login');
});
// Route::apiResource('product', 'Api/ProductController');

// No authentication required
Route::group(["prefix" => "user"],function(){
    // product api
    Route::post('product', 'Api\Product\ProductController@index');
    Route::get('product/{id}', 'Api\Product\ProductController@show');

    // Blog api
    Route::post('blog', 'Api\Blog\BlogController@index');
    Route::get('blog/{id}', 'Api\Blog\BlogController@show');
});

// All authenticated required
Route::group([  'middleware' => 'auth:api'], function() {
    // product api
    Route::post('product', 'Api\Product\AdminProductController@index');
    Route::post('product/add', 'Api\Product\AdminProductController@store');
    Route::post('blog/edit/{seller_id}', 'Api\Blog\AdminProductController@edit');

    // blog api
    Route::post('blog', 'Api\Blog\AdminBlogController@index');
    Route::post('blog/add', 'Api\Blog\AdminBlogController@store');
    Route::post('blog/edit/{seller_id}', 'Api\Blog\AdminBlogController@edit');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
