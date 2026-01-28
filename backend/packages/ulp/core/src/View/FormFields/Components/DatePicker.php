<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

class TimePicker extends DateTimePicker {

  protected string $type = 'date';
  protected bool $hasDate = true;
  protected bool $hasTime = false;

  public function hasDate(): bool {
    return false;
  }

}