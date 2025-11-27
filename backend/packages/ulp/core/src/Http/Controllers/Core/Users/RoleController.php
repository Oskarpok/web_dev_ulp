<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

class RoleController extends \Ulp\Core\Http\Controllers\BaseCrudController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Users\Role::class;
  protected const ROUTE_NAME = 'core.roles.';

  protected function titles(): array {
    return [
      'index' => 'Roles Panel',
      'create' => 'Roles Create Panel',
      'edit' => 'Roles Edit Panel',
      'show' => 'Roles Show Panel',
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