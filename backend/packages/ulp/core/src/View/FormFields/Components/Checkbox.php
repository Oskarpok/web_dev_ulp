<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

class Checkbox extends TextInput {

  protected string $type = 'checkbox';

  public function value($value){
    $this->value = (bool) $value;  
    return $this;
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.select.checkbox';
  }

}