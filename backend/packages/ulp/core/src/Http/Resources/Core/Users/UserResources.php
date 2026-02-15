<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Resources\Core\Users;

use Ulp\Core\View\FormFields\Components\Checkbox;
use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\DateTimePicker;
use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

class UserResources extends \Ulp\Core\Crud\Resources\BaseResource {

  public static function prepareIndexButtons($routeName): array {
    return [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => $routeName . 'create',
        'label' => 'Add',
        'icone' => 'fa-solid fa-plus',
      ]),
    ];
  }

  public static function createButtons($routeName): array {
    return [
      ButtonsTypeController::make([
        'type' => 'submit',
        'label' => 'Save',
        'icone' => 'fa-solid fa-file',
      ]),
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => $routeName . 'index',
        'label' => 'Return',
        'icone' => 'fa-solid fa-arrow-left',
      ]),
    ];
  }

  public static function createFields(): array {
    return [
      TextInput::make('phone')->tel()->label('Phone')->required(),
      TextInput::make('email')->email()->label('Email')->required(),
      TextInput::make('password')->password()->label('Password')->required(),
      Checkbox::make('is_active ')->label('Is Active'),
    ];
  }

  public static function showButtons($routeName): array {
    return [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => $routeName . 'index',
        'label' => 'Return',
        'icone' => 'fa-solid fa-arrow-left',
      ]),
    ];
  }

  public static function showFields(): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      TextInput::make('phone')->tel()->label('Phone')->required()->readonly(),
      TextInput::make('email')->email()->label('Email')->required()->readonly(),
      TextInput::make('password')->password()->label('Password')->required()->readonly(),
      Checkbox::make('is_active ')->label('Is Active')->disabled(),
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  public static function editButtons($routeName): array {
    return [
      ButtonsTypeController::make([
        'type' => 'submit',
        'label' => 'Save',
        'icone' => 'fa-solid fa-file',
      ]),
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => $routeName. 'index',
        'label' => 'Return',
        'icone' => 'fa-solid fa-arrow-left',
      ]),
    ];
  }

  public static function editFields(): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      TextInput::make('phone')->tel()->label('Phone')->required(),
      TextInput::make('email')->email()->label('Email')->required(),
      TextInput::make('password')->password()->label('Password')->required(),
      Checkbox::make('is_active ')->label('Is Active'),
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

}