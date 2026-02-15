<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

use Ulp\Core\View\FormFields\Components\Traits\BeDisabled;
use Ulp\Core\View\FormFields\Components\Traits\BeReadonly;
use Ulp\Core\View\FormFields\Components\Traits\BeRequired;
use Ulp\Core\View\FormFields\Components\Traits\DataFormat;

class DateTimePicker extends Input {

  use BeDisabled, BeReadonly, BeRequired, DataFormat;

  protected string $type = 'date-time';
  protected bool $hasDate = true;
  protected bool $hasTime = true;
  protected string $view = 'core::components.form_fields.date_time.date_time';

  public function value($value){
    $this->value = is_object($value) 
      ? $value->format($this->format ?? $this->format)
      : $value;  
    return $this;
  }

  public function hasDate(): bool {
    return (bool) $this->hasDate;
  }

  public function hasTime(): bool {
    return (bool) $this->hasTime;
  }

}