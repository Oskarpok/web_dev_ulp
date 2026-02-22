<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

use Closure;

trait BeReadonly {

  protected Closure|bool $readonly = false;

  public function readonly(bool $state = true): static {
    $this->readonly = $state;
    return $this;
  }

}