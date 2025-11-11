<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('core.')
  ->namespace('\Ulp\Core\Http\Controllers\Core')
  ->group(function () {
    Route::resource('users', 'Users\UserController');
    Route::resource('params', 'System\ParamController');
    Route::resource('orders', 'Production\OrderController');
    Route::resource('products', 'Production\ProductController');
});

Route::prefix('admin')->name('core.')
  ->namespace('\Ulp\Core\Http\Controllers\Core\Front')
  ->group(function () {
    Route::resource('languages', 'LanguagesController');
    Route::resource('texts', 'TextsController');
});