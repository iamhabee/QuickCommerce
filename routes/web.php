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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('product', 'ProductController', ['except' => ['show']]);
	Route::resource('order', 'OrderController', ['except' => ['show']]);
	Route::resource('blog', 'BlogController', ['except' => ['show']]);
	Route::resource('brand', 'BrandController', ['except' => ['show']]);
	Route::resource('variants', 'VariantController', ['except' => ['show']]);
	Route::resource('transaction', 'TransactionController', ['except' => ['show']]);
	Route::resource('wishlist', 'WishlistController', ['except' => ['show']]);
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::post('add_variant', ['as' => 'product.add_variant', 'uses' => 'ProductController@add_variant']);
	Route::get('create_variant', ['as' => 'product.create_variant', 'uses' => 'ProductController@create_variant']);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::put('profile/update_category', ['as' => 'profile.update_category', 'uses' => 'ProfileController@update_category']);
	Route::put('profile/update_picture', ['as' => 'profile.update_picture', 'uses' => 'ProfileController@update_picture']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

