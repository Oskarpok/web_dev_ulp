<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

use Ulp\Core\Enums\UsersType;
use Ulp\Core\View\FormFields\Components\TextInput;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Users',
  group: 'Users',
  route: 'core.users.index',
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

  protected function indexTable(\Illuminate\Http\Request $request): array {
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

  protected function formFields(): array {
    $readonly = (request()->route()->getActionMethod() === 'show' ? true : false);
    return [
      TextInput::make('first_name')->label('First Name')->required()->readonly($readonly),
      TextInput::make('sur_name')->label('Sur Name')->required()->readonly($readonly),
    ];
  }

}