<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('core.')
  ->namespace('\Ulp\Core\Http\Controllers\Core')->group(function () {
    Route::resource('users', 'Users\UserController');
    Route::resource('params', 'System\ParamController');
    Route::resource('orders', 'Production\OrderController');
    Route::resource('products', 'Production\ProductController');
    Route::resource('languages', 'Front\LanguagesController');
    Route::resource('texts', 'Front\TextsController');
});