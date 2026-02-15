<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Permission',
  group: 'Users',
  route: 'core.permissions.index',
)]

class PermissionController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const RESOURCES_CLASS = \Ulp\Core\Http\Resources\Core\Users\PermissionResources::class;
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

  protected function indexTable(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'guard_name', 'created_at', 'updated_at',
      ])->paginate(30), 
      'labels' => [
        'Id', 'Name', 'Guard Name', 'Created At', 'Updated At',
      ],
      'filterable' => [
        'id' => true, 'name'=> true, 'guard_name'=> true, 
        'created_at'=> true, 'updated_at'=> true,
      ],
    ];
  }

}