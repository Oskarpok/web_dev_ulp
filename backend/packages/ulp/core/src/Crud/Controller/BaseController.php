<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Controller;

use Illuminate\Support\Facades\Route;
use Ulp\Core\Crud\Concerns\CrudeMethods;
use Ulp\Core\Crud\Concerns\BaseCrudeFields;


abstract class BaseController extends \Illuminate\Routing\Controller {

  use CrudeMethods, BaseCrudeFields;

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

}