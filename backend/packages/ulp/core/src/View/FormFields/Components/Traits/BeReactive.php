<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

trait BeReactive {

  protected bool $reactive = false;

  public function reactive(bool $state = true): static {
    $this->reactive = $state;
    return $this;
  }

}