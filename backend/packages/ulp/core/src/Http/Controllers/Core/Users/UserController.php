<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

use Ulp\Core\Enums\UsersType;
use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\Select\SelectTypeControl;
use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Users',
  group: 'Users',
  route: 'core.users.index',
  roles: [1,2,3,],
)]

class UserController extends \Ulp\Core\Http\Controllers\BaseCrudController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Users\User::class;
  protected const ROUTE_NAME = 'core.users.';

  protected function titles(): array {
    return [
      'index' => 'Users Panel',
      'create' => 'Users Create Panel',
      'edit' => 'Users Edit Panel',
      'show' => 'Users Show Panel',
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'first_name', 'sur_name', 'phone', 'email', 'type', 
        'is_active', 'email_verified_at', 'created_at', 'updated_at',
      ])->get(), 
      'labels' => [
        'Id', 'First name', 'Sur name', 'Phone', 'Email', 
        'Type', 'Active', 'Verified at', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'first_name' => true, 'sur_name' => true, 
        'phone' => true, 'email' => true, 'type' => true, 'is_active' => true,
        'email_verified_at' => true, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function getFormFields($data = null): array {
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    $validationRules = self::MODEL_CLASS::validationRules();
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
        'name' => 'first_name',
        'label' => 'First Name',
        'value' => $data?->first_name,
        'required' => in_array('required', $validationRules['first_name']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      TextTypeController::make([
        'type' => 'text',
        'name' => 'sur_name',
        'label' => 'Sur Name',
        'value' => $data?->sur_name,
        'required' => in_array('required', $validationRules['sur_name']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      TextTypeController::make([
        'type' => 'text',
        'name' => 'phone',
        'label' => 'Phone',
        'value' => $data?->phone,
        'required' => in_array('required', $validationRules['phone']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      TextTypeController::make([
        'type' => 'email',
        'name' => 'email',
        'label' => 'Email',
        'value' => $data?->email,
        'required' => in_array('required', $validationRules['email']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      SelectTypeControl::make([
        'type' => 'checkbox',
        'name' => 'is_active',
        'label' => 'Active',
        'required' => in_array('required', $validationRules['is_active']),
        'value' => $data?->is_active,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      SelectTypeControl::make([
        'type' => 'select',
        'name' => 'type',
        'label' => 'Type',
        'options' => UsersType::toArray() ?? [],
        'required' => in_array('required', $validationRules['type']),
        'value' => $data?->type,
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