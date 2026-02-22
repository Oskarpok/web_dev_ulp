<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Resources\Core\Front;

use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\Checkbox;
use Ulp\Core\View\FormFields\Components\DateTimePicker;

class LanguagesResources extends \Ulp\Core\Crud\Resources\BaseResource {

  public static function createFields($data = null): array {
    return [
      TextInput::make('name')->label('Name')->required(),
      TextInput::make('shortcut')->label('Shortcut')->required(),
      Checkbox::make('is_active')->label('Is Active'),
    ];
  }

  public static function showFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      TextInput::make('name')->label('Name')->readonly(),
      TextInput::make('shortcut')->label('Shortcut')->readonly(),
      Checkbox::make('is_active')->label('Is Active')->disabled(),
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  public static function editFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      TextInput::make('name')->label('Name')->required(),
      TextInput::make('shortcut')->label('Shortcut')->required(),
      Checkbox::make('is_active')->label('Is Active'),
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

}