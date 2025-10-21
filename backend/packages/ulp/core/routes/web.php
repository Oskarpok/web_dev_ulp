<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')
  ->namespace('\Ulp\Core\Http\Controllers\Core')
  ->group(function () {
    Route::resource('params', 'ParamController');
    Route::resource('users', 'UserController');
    
});