<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core;

class OrdersController extends \Ulp\Core\Http\Controllers\BaseController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Order::class;
  protected const ROUTE_NAME = 'core.orders.';

  protected function titles(): array {
    return [
      //
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      //
    ];
  }

  protected function getFormFields($data = null): array {
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    $validationRules = self::MODEL_CLASS::validationRules();
    return [
      //
    ];
  }

}