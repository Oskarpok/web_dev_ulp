<?php
 
namespace Ulp\Core\Crud\Resources;

use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

abstract class ReadOnlyResource {

  /**
   * @return array List of fields for database record.
   */
  abstract public static function showFields($data = null): array;

  public static function prepareIndexButtons($routeName): array {
    return [];
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

}