<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Resources\Core\Users;

use Ulp\Core\Models\Core\Users\Role;
use Ulp\Core\View\FormFields\Components\Select;
use Ulp\Core\View\FormFields\Components\Checkbox;
use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\DateTimePicker;

class UserResources extends \Ulp\Core\Crud\Resources\BaseResource {

  public static function createFields($data = null): array {
    return [
      TextInput::make('phone')->tel()->label('Phone')->required(),
      TextInput::make('email')->email()->label('Email')->required(),
      TextInput::make('password')->password()->label('Password')->required(),
      Checkbox::make('is_active')->label('Is Active'),
      Select::make('role')->label('Role')->searchable()->multiple()->required()
        ->options(Role::pluck('name', 'id')->toArray()),

        
    ];
  }

  public static function showFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly()->readonly(),
      TextInput::make('phone')->tel()->label('Phone')->required()->readonly(),
      TextInput::make('email')->email()->label('Email')->required()->readonly(),
      TextInput::make('password')->password()->label('Password')->required()->readonly(),
      Checkbox::make('is_active')->label('Is Active')->disabled(),
      Select::make('role')->label('Role')->searchable()->multiple()->required()
        ->options(Role::pluck('name', 'id')->toArray())->disabled(),



      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  public static function editFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      TextInput::make('phone')->tel()->label('Phone')->required(),
      TextInput::make('email')->email()->label('Email')->required(),
      TextInput::make('password')->password()->label('Password')->required(),
      Checkbox::make('is_active')->label('Is Active'),
      Select::make('role')->label('Role')->searchable()->multiple()->required()
        ->options(Role::pluck('name', 'id')->toArray()),

      TextInput::make('first_name')->label('First Name')->required()
        ->visible(fn ($get) => !empty(array_intersect(['1', '3'], 
          (array)($get('role') ?? [])))), 
      TextInput::make('sur_name')->label('Sur Name')->required()
        ->visible(fn ($get) => !empty(array_intersect(['1', '3'], 
          (array)($get('role') ?? [])))),
      TextInput::make('company_name')->label('Company Name')->required()
        ->visible(fn ($get) => in_array('2', ($get('role')))),  

      TextInput::make('street')->label('Street')->required()
        ->visible(fn ($get) => !empty(array_intersect(['1', '2'], 
          (array)($get('role') ?? [])))),
      TextInput::make('city')->label('City')->required()
        ->visible(fn ($get) => !empty(array_intersect(['1', '2'], 
          (array)($get('role') ?? [])))),
      TextInput::make('postcode')->label('Postcode')->required()
        ->visible(fn ($get) => !empty(array_intersect(['1', '2'], 
          (array)($get('role') ?? [])))),

      TextInput::make('pesel')->label('Pesel')->required()
        ->visible(fn ($get) => !empty(array_intersect(['1', '3'], 
          (array)($get('role') ?? [])))),
      TextInput::make('nip')->label('Nip')->required()    
        ->visible(fn ($get) => in_array('2', ($get('role')))),  
      TextInput::make('regon')->label('Regon')->required()        
        ->visible(fn ($get) => in_array('2', ($get('role')))),  
      TextInput::make('krs')->label('Krs')->required()        
        ->visible(fn ($get) => in_array('2', ($get('role')))),  

      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

}