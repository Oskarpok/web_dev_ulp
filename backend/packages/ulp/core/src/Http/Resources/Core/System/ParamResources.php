<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Resources\Core\System;

use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\DateTimePicker;

class ParamResources extends \Ulp\Core\Crud\Resources\BaseResource {

  public static function createFields($data = null): array {
    return [
      TextInput::make('name')->label('Name')->required(),

    ];
  }

  public static function showFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      TextInput::make('name')->label('Name')->required()->readonly(),

      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  public static function editFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      TextInput::make('name')->label('Name')->required(),


      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

}