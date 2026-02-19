<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Resources\Core\Users;

use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\DateTimePicker;

class PermissionResources extends \Ulp\Core\Crud\Resources\BaseResource {

  public static function createFields($data = null): array {
    return [

    ];
  }

  public static function showFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  public static function editFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

}