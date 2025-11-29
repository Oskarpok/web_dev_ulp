<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Roles',
  group: 'Users',
  route: 'core.roles.index',
)]

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
      TextTypeController::make([
        'type' => 'text',
        'name' => 'name',
        'label' => 'Name',
        'value' => $data?->name,
        'required' => true,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      \Ulp\Core\View\FormFields\Select\SelectTypeControl::make([
        'type' => 'select',
        'name' => 'guard_name',
        'label' => 'Guard Name',
        'options' => array_keys(config('auth.guards')) ?? [],
        'required' => true,
        'value' => $data?->guard_name,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      (function($currentRoute, $created_at) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return DateTimeTypeControl::make([
            'type' => 'date_time',
            'name' => 'created_at',
            'label' => 'Utworzony',
            'readonly' => true,
            'value' => $created_at,
          ]);
        }
      })($currentRoute, $data?->created_at),
      (function($currentRoute, $updated_at) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return DateTimeTypeControl::make([
            'type' => 'date_time',
            'name' => 'updated_at',
            'label' => 'Zaktualizowany',
            'readonly' => true,
            'value' => $updated_at,
          ]);
        }
      })($currentRoute, $data?->updated_at),
    ];
  }

}