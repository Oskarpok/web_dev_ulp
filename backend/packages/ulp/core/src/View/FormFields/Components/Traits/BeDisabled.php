<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

use Closure;

trait BeDisabled {

  protected Closure|bool $disabled = false;

  public function disabled(bool $state = true): static {
    $this->disabled = $state;
    return $this;
  }

}