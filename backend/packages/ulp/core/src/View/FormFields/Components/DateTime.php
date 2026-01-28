<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

use Ulp\Core\View\FormFields\Components\Traits\BeDisabled;
use Ulp\Core\View\FormFields\Components\Traits\BeReadonly;
use Ulp\Core\View\FormFields\Components\Traits\BeRequired;
use Ulp\Core\View\FormFields\Components\Traits\DataFormat;

class DateTime extends Input {

  use BeDisabled, BeReadonly, BeRequired, DataFormat;

  public function value($value){
    $this->value = is_object($value) 
      ? $value->format($this->format ?? $this->format)
      : $value;  
    return $this;
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.date_time.date_time';
  }

}