<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

trait BeRequired {

  protected bool $required = false;

  public function required(bool $state = true): static {
    $this->required = $state;
    return $this;
  }

}