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
    Route::get('product', 'Api\Product\ProductController@index');
    Route::get('single_product/{id}', 'Api\Product\ProductController@single_product');
    Route::get('latest_product', 'Api\Product\ProductController@latest_product');

    // Blog api
    Route::post('blog', 'Api\Blog\BlogController@index');
    Route::get('blog/{id}', 'Api\Blog\BlogController@show');

    // Home screen api
    Route::post('followers', 'Api\SellerFollowerController@index');
    Route::get('seller_status/{id?}', 'Api\HomeController@seller_status');

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

    // follow and unfollow
    Route::post('followOrUnfollow', 'Api\SellerFollowerController@followOrUnfollow');

    // add to cart
    Route::post('addToCart', 'Api\ProductController@addToCart');
    Route::post('getAddToCart', 'Api\ProductController@getAddToCart');

    // profile
    Route::post('update_profile', 'Api\auth\LoginController@update_profile');
    Route::post('update_picture', 'Api\auth\LoginController@update_picture');
    Route::post('change_password', 'Api\auth\LoginController@change_password');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
