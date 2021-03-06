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

Route::group(['middleware' => 'auth', 'namespace' => 'Backend'], function () {
    Route::get('/home/{from?}/{to?}', 'HomeController@index')->name('home');
    Route::resource('products', 'ProductController');
    Route::resource('stocks', 'StockController');
    Route::resource('orders', 'OrderController');
    Route::resource('expenses', 'ExpenseController');
    
});
