<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Resources\Core\Media\Resources;

use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\DateTimePicker;
use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

class ResourceCategoriesResources extends \Ulp\Core\Crud\Resources\BaseResource {

  public static function prepareIndexButtons($routeName): array {
    return [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => 'core.resources.index',
        'label' => 'Resources',
        'icone' => 'fa-solid fa-file',
      ]),
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => 'core.resources_extensions.index',
        'label' => 'Resources Extensions',
        'icone' => 'fa-solid fa-file-signature',
      ]),
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => $routeName . 'create',
        'label' => 'Add',
        'icone' => 'fa-solid fa-plus',
      ]),
    ];
  }

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