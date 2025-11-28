<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'guest'])
  ->namespace('Ulp\Core\Http\Controllers\Core\Users')
  ->group(function () {
    Route::get('login', 'AuthController@showLoginForm')->name('loginForm');
    Route::post('login', 'AuthController@login')->name('login');
});

Route::middleware(['web', 'auth'])
  ->prefix('admin')->name('core.')
  ->namespace('Ulp\Core\Http\Controllers\Core')
  ->group(function () {
    Route::get('/dashboard', fn() => view('core::auth.dashboard'))->name('dashboard');
    Route::post('logout', 'Users\AuthController@logout')->name('logout');

    Route::resource('users', 'Users\UserController');
    Route::resource('roles', 'Users\RoleController');
    Route::resource('permissions', 'Users\PermissionController');

    Route::resource('params', 'System\ParamController');

    Route::resource('orders', 'Production\OrderController');
    Route::resource('products', 'Production\ProductController');

    Route::resource('languages', 'Front\LanguagesController');
    Route::resource('texts', 'Front\TextsController');

});