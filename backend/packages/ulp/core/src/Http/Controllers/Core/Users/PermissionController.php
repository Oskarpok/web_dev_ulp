<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

class PermissionController extends \Ulp\Core\Http\Controllers\BaseCrudController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Users\Permission::class;
  protected const ROUTE_NAME = 'core.permissions.';

  protected function titles(): array {
    return [
      'index' => 'Permission Panel',
      'create' => 'Permission Create Panel',
      'edit' => 'Permission Edit Panel',
      'show' => 'Permission Show Panel',
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      //
    ];
  }

  protected function getFormFields($data = null): array {
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    return [
      //
    ];
  }

}