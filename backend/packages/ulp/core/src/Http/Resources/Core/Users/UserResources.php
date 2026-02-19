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
      Checkbox::make('is_active ')->label('Is Active'),
      Select::make('role')->label('Role')->searchable()->multiple()->required()
        ->options(Role::pluck('name', 'id')->toArray()),
        ...array_map(fn($field) => $field->readonly(), 
        match($data?->roles->first()?->details_table) {
          'system_user_details' => self::systemUserFields(),
          'company_details' => self::companyFields(),
          'user_details' => self::regularUserFields(),
          default => [],
        }
      ),
    ];
  }

  public static function showFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly()->readonly(),
      TextInput::make('phone')->tel()->label('Phone')->required()->readonly(),
      TextInput::make('email')->email()->label('Email')->required()->readonly(),
      TextInput::make('password')->password()->label('Password')->required()->readonly(),
      Checkbox::make('is_active ')->label('Is Active')->disabled(),
      Select::make('role')->label('Role')->searchable()->multiple()->required()
        ->options(Role::pluck('name', 'id')->toArray())->disabled(),
      ...array_map(fn($field) => $field->readonly(), 
        match($data?->roles->first()?->details_table) {
          'system_user_details' => self::systemUserFields(),
          'company_details' => self::companyFields(),
          'user_details' => self::regularUserFields(),
          default => [],
        }
      ),
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
      Checkbox::make('is_active ')->label('Is Active'),
      Select::make('role')->label('Role')->searchable()->multiple()->required()
        ->options(Role::pluck('name', 'id')->toArray()),
      ...match($data?->roles->first()?->details_table) {
        'system_user_details' => self::systemUserFields(),
        'company_details' => self::companyFields(),
        'user_details' => self::regularUserFields(),
        default => [],
      },
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  protected static function systemUserFields(): array {
    return [
      TextInput::make('first_name')->label('First Name')->required(),
      TextInput::make('sur_name')->label('Sur Name')->required(),
      TextInput::make('pesel')->label('Pesel')->required(),
    ];
  }

  protected static function companyFields(): array {
    return [
      TextInput::make('company_name')->label('Company Name')->required(),
      TextInput::make('street')->label('Street')->required(),
      TextInput::make('city')->label('City')->required(),
      TextInput::make('postcode')->label('Postcode')->required(),
      TextInput::make('nip')->label('Nip')->required(),
      TextInput::make('regon')->label('Regon')->required(),
      TextInput::make('krs')->label('Krs')->required(),
    ];
  }

  protected static function regularUserFields(): array {
    return [
      TextInput::make('first_name')->label('First Name')->required(),
      TextInput::make('sur_name')->label('Sur Name')->required(),
      TextInput::make('pesel')->label('Pesel')->required(),
      TextInput::make('street')->label('Street')->required(),
      TextInput::make('city')->label('City')->required(),
      TextInput::make('postcode')->label('Postcode')->required(),
    ];
  }

}