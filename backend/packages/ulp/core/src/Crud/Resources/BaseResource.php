<?php
 
namespace Ulp\Core\Crud\Resources;

use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

abstract class BaseResource {

  /**
   * @return array List of fields for database record.
   */
  abstract public static function createFields($data = null): array;
  abstract public static function showFields($data = null): array;
  abstract public static function editFields($data = null): array;

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

  public static function editButtons($routeName): array {
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

}