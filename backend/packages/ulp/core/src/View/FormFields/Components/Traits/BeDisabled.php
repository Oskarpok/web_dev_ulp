<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

trait BeDisabled {

  protected bool $disabled = false;

  public function disabled(bool $state = true): static {
    $this->disabled = $state;
    return $this;
  }

}