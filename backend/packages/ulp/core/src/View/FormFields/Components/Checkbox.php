<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

use Ulp\Core\View\FormFields\Components\Traits\BeDisabled;
use Ulp\Core\View\FormFields\Components\Traits\BeRequired;

class Checkbox extends Input {

  use BeDisabled, BeRequired;

  protected string $type = 'checkbox';

  public function value($value){
    $this->value = (bool) $value;  
    return $this;
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.select.checkbox';
  }

}