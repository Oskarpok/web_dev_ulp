<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Select\Fields;

class CheckBoxControl extends \Ulp\Core\View\FormFields\Select\BaseSelectField {

  protected bool $value;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = (bool) $data['value'] ?? false;
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.select.checkbox';
  }

}