<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('core.')
  ->namespace('\Ulp\Core\Http\Controllers\Core')
  ->group(function () {
    Route::resource('users', 'UserController');
    Route::resource('params', 'ParamController');
    Route::resource('orders', 'OrderController');
    Route::resource('products', 'ProductController');
});

Route::prefix('admin')->name('core.')
  ->namespace('\Ulp\Core\Http\Controllers\Core\Front')
  ->group(function () {
    Route::resource('languages', 'LanguagesController');
    Route::resource('texts', 'TextsController');
});