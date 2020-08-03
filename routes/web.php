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

Auth::routes();

Route::match(['get'], 'store/info/{id?}', 'StoreController@info');
Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth']);
Route::resource('store', 'StoreController')->middleware(['auth']);
Route::resource('product', 'ProductController')->middleware(['auth']);
Route::resource('log', 'LogController')->middleware(['auth']);
Route::resource('log/message', 'LogController')->middleware(['auth']);
