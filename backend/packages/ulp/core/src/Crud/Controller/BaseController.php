<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ulp\Core\Crud\Concerns\CrudeMethods;
use Ulp\Core\Crud\Concerns\BaseCrudeFields;
use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;


abstract class BaseController extends \Illuminate\Routing\Controller {

  use CrudeMethods, BaseCrudeFields;

  /**
   * Return an array of vie index requaier data.
   *
   * @return array List of fields elements for the given controller.
   */
  abstract protected function indexTable(Request $request): array;

  //
  public function heckRowButtonsAcces($destination): array {
    return [
      'show' => Route::has($destination . 'show'),
      'edit' => Route::has($destination . 'edit'),
      'destroy' => Route::has($destination . 'destroy'),
    ];
  }

  // Prepare buttobs for index vievs
  protected function prepareIndexButtons(): array {
    return Route::has(static::ROUTE_NAME . 'create') ? [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => static::ROUTE_NAME . 'create',
        'label' => $this->titles()['recordAddButton'] ?? 'Add',
        'icone' => 'fa-solid fa-plus',
      ]),
    ] : [];
  }

  /**
   * Prepares the data for the index view by calling the indexTable()
   * method with the current request, and then returns the corresponding
   * Blade view with the prepared data.
   *
   * @param \Illuminate\Http\Request $request  The incoming HTTP request.
   * @return \Illuminate\View\View  The rendered index view.
   */
  public function index(Request $request): \Illuminate\View\View {
    $data = $this->indexTable($request);
    return view(self::CRUD_VIEWS . 'index', [
      'title' => $this->titles()['index'] ?? '',
      'buttons' => $this->prepareIndexButtons(),
      'table' => new \Ulp\Core\View\FormFields\Extra\Fields\IndexControl([
        'type' => 'intex',
        'labels' => $data['labels'],
        'filterable' => $data['filterable'],
        'data' => $data['data'],
        'destinations' => static::ROUTE_NAME,
        'resolveButtons' => $this->heckRowButtonsAcces(static::ROUTE_NAME),
      ]),
    ]);
  }

  /**
   * Prepares widowed crud form elements based on their specific fields, 
   * depending on the controller used.
   * 
   * @return array List of used fields
   */
  protected function prepareFormFields(): array {
    $isNotCreate = (request()->route()->getActionMethod() === 'create' ? false : true);
    return [
      'fields' => array_merge($isNotCreate ? $this->getIdField() : [],
        $this->formFields(),
        $isNotCreate ? $this->getTimestampFields() : [],
      ),
      'buttons' => [
        ...$this->formFieldsButtons(Route::currentRouteName()),
      ],
    ];
  }

  // Preper submit button for crud operations
  protected function formFieldsButtons($currentRoute) {
    $buttons = [];

    if ($currentRoute !== static::ROUTE_NAME . 'show') {
      $buttons[] = ButtonsTypeController::make([
        'type' => 'submit',
        'label' => 'Save',
        'icone' => 'fa-solid fa-file',
      ]);
    }

    $buttons[] = ButtonsTypeController::make([
      'type' => 'anchore',
      'routeName' => static::ROUTE_NAME . 'index',
      'label' => 'Return',
      'icone' => 'fa-solid fa-arrow-left',
    ]);

    return $buttons;
  }

}