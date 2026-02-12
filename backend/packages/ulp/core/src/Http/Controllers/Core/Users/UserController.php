<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

use Ulp\Core\View\FormFields\Components\Checkbox;
use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\DateTimePicker;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Users',
  group: 'Users',
  route: 'core.users.index',
)]

class UserController extends \Ulp\Core\Crud\Controller\BaseController {

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

  protected function formFields(): array {
    $readonly = (request()->route()->getActionMethod() === 'show' ? true : false);
    $fields = [
      TextInput::make('phone')->tel()->label('Phone')->required()->readonly($readonly),
      TextInput::make('email')->email()->label('Email')->required()->readonly($readonly),
      TextInput::make('password')->password()->label('Password')->required()->readonly($readonly),
      Checkbox::make('is_active ')->label('Is Active')->disabled($readonly),
    ];

    if(request()->route()->getActionMethod() === 'create' ? false : true) {
      $fields[] =  DateTimePicker::make('email_verified_at ')->label('Email Verified At')->readonly();
    }

    return $fields;
  }

}