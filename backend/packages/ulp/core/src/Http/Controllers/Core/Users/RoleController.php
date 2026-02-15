<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Roles',
  group: 'Users',
  route: 'core.roles.index',
)]

class RoleController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const LIVEWIER_CLASS = \Ulp\Core\Http\Resources\Core\Users\RoleResources::class;
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