<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

class TimePicker extends DateTimePicker {

  protected string $type = 'time';
  protected bool $hasDate = false;
  protected bool $hasTime = true;

  public function hasDate(): bool {
    return false;
  }

}