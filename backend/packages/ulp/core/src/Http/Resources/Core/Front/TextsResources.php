<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Resources\Core\Front;

use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

class TextsResources extends \Ulp\Core\Crud\Resources\BaseResource {

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

    ];
  }

}