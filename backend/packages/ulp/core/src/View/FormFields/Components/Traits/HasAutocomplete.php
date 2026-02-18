<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

use Closure;

trait HasAutocomplete {

  protected Closure|string $autocomplete = '';

  public function autocomplete(string $autocomplete = ''): static {
    $this->autocomplete = $autocomplete;
    return $this;
  }

}