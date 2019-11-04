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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('administracion')->middleware('auth')->namespace('Admin')->group(function(){
  Route::get('/', 'DashboardController@dashboard')->name('dashboard');

  Route::resource('categorias', 'CategoriesController')->parameters(['categorias' => 'category']);
  Route::resource('marcas', 'BrandsController')->parameters(['marcas' => 'brand']);

  Route::post('uploads', 'UploadsController@store');
  Route::resource('productos', 'ProductsController')->parameters(['productos' => 'product']);
});

Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');
