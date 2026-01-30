<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Concerns;

use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\DateTimePicker;
  
trait BaseCrudeFields {

  // Preper id field for crude operations
  protected function getIdField(): array {
    return [TextInput::make('id')->label('Id')->numeric()->readonly()];
  }

  // Preper time stamps fields for crude operations
  protected function getTimestampFields(): array {
    return [
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  /**
   * Return an array of form fields used in the create show edit views.
   *
   * @return array List of fields elements for the given controller.
   */
  abstract protected function formFields(): array;

}