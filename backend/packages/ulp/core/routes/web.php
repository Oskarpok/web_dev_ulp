<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')
  ->namespace('Ulp\Core\Http\Controllers\Core\Users')
  ->group(function () {
    Route::get('login', 'AuthController@showLoginForm')->name('loginForm');
    Route::post('login', 'AuthController@login')->name('login');
});

Route::prefix('admin')->name('core.')
  ->namespace('\Ulp\Core\Http\Controllers\Core')->group(function () {
    Route::resource('users', 'Users\UserController');
    Route::resource('params', 'System\ParamController');
    Route::resource('orders', 'Production\OrderController');
    Route::resource('products', 'Production\ProductController');
    Route::resource('languages', 'Front\LanguagesController');
    Route::resource('texts', 'Front\TextsController');
});