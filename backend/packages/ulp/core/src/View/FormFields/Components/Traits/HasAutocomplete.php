<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

trait HasAutocomplete {

  protected string $autocomplete = '';

  public function autocomplete(string $autocomplete = ''): static {
    $this->autocomplete = $autocomplete;
    return $this;
  }

}