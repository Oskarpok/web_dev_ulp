<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

use Ulp\Core\View\FormFields\Components\Traits\BeDisabled;
use Ulp\Core\View\FormFields\Components\Traits\BeReadonly;
use Ulp\Core\View\FormFields\Components\Traits\BeRequired;

class TextInput extends Input {

  use BeDisabled, BeReadonly, BeRequired;

  protected string $value;

  public function value(string $value): static {
    $this->value = $value;
    return $this;
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.text.text';
  }
  
}