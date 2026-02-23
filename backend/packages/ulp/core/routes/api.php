<?php

use Illuminate\Support\Facades\Route;

use Ulp\Core\Http\Controllers\Api\TextController;

// Przykład endpointu API
Route::middleware('api')->prefix('api/')->group(function () {
  Route::get('/text/translation', [TextController::class, 'getTranslations']);
});