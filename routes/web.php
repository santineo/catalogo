<?php

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

Route::get('/', 'FrontController@home')->name('home');

Route::prefix('productos')->group(function(){
  Route::get('/', 'ProductsController@index')->name('front.products.index');
  Route::get('/{slug}', 'ProductsController@show')->name('front.products.show');
});

Route::prefix('checkout')->group(function(){
  Route::get('/', 'CheckoutController@create')->name('front.checkout.create');
  Route::post('/', 'CheckoutController@store')->name('front.checkout.store');
});

Route::prefix('cart')->group(function(){
  Route::get('/', 'CartController@cart');
  Route::post('getCart', 'CartController@getCart');
  Route::post('add', 'CartController@add');
  Route::post('update', 'CartController@update');
  Route::post('remove', 'CartController@remove');
});

Route::get('/', 'FrontController@home')->name('home');

Route::prefix('administracion')->middleware('auth')->namespace('Admin')->group(function(){
  Route::get('/', 'DashboardController@dashboard')->name('dashboard');

  Route::resource('categorias', 'CategoriesController')->parameters(['categorias' => 'category']);
  Route::resource('marcas', 'BrandsController')->parameters(['marcas' => 'brand']);

  Route::post('uploads', 'UploadsController@store');
  Route::get('productos/fetch', 'ProductsController@getProducts');
  Route::resource('productos', 'ProductsController')->parameters(['productos' => 'product']);

  Route::resource('pedidos', 'OrdersController')->except(['destroy'])->parameters(['pedidos' => 'order']);
  Route::post('/pedidos/{order}/status', 'OrdersController@updateStatus');
  Route::get('/pedidos/{order}/productos', 'OrdersController@getProducts');
});

Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');
