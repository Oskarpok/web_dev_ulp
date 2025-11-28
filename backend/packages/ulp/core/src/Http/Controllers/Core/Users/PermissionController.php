<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

use Ulp\Core\View\FormFields\Text\TextTypeController;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Permission',
  group: 'Users',
  route: 'core.permissions.index',
  roles: [1,2,3,],
)]

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
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'guard_name', 'created_at', 'updated_at',
      ])->get(), 
      'labels' => [
        'Id', 'Name', 'Guard Name', 'Created At', 'Updated At',
      ],
      'filterable' => [
        'id' => true, 'name'=> true, 'guard_name'=> true, 
        'created_at'=> true, 'updated_at'=> true,
      ],
    ];
  }

  protected function getFormFields($data = null): array {
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    return [
      (function($currentRoute, $id) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return TextTypeController::make([
            'type' => 'number',
            'name' => 'id',
            'label' => 'ID',
            'value' => $id,
            'readonly' => true,
          ]);
        }
      })($currentRoute, $data?->id),
    ];


  }

}