<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Users',
  group: 'Users',
  route: 'core.users.index',
)]

class UserController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const RESOURCES_CLASS = \Ulp\Core\Http\Resources\Core\Users\UserResources::class;
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
      'data' => self::MODEL_CLASS::with([
        'userDetails', 'companyDetails', 'systemUserDetails'
      ])->filter($request, [
        'id', 'first_name', 'sur_name', 'company_name', 'phone',  'email', 
        'is_active', 'email_verified_at', 'created_at', 'updated_at',
      ])->paginate(30), 
      'labels' => [
        'Id', 'First name', 'Sur Name', 'Company Name', 'Phone', 'Email', 
        'Active',  'Verified at', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'first_name'=> true, 'sur_name'=> true, 'company_name'=> true, 
        'phone' => true, 'email' => true, 'is_active' => true,
        'email_verified_at' => true, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

}