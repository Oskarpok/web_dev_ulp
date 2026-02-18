<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

use Closure;

trait BeReactive {

  protected Closure|bool $reactive = false;

  public function reactive(bool $state = true): static {
    $this->reactive = $state;
    return $this;
  }

}