<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

use Ulp\Core\View\FormFields\Components\Traits\BeDisabled;
use Ulp\Core\View\FormFields\Components\Traits\BeReadonly;
use Ulp\Core\View\FormFields\Components\Traits\BeRequired;
use Ulp\Core\View\FormFields\Components\Traits\HasAutocomplete;

class TextInput extends Input {

  use BeDisabled, BeReadonly, BeRequired, HasAutocomplete;

  protected string $type = 'text';

  protected function resolveView(): string {
    return 'core::components.form_fields.text.text';
  }

  public function email() {
    $this->type = 'email';  
    return $this;
  }

  public function numeric() {
    $this->type = 'numeric';  
    return $this;
  }

  public function integer() {
    $this->type = 'integer';  
    return $this;
  }

  public function password() {
    $this->type = 'password';  
    return $this;
  }

  public function tel() {
    $this->type = 'tel';  
    return $this;
  }

  public function url() {
    $this->type = 'url';  
    return $this;
  }

}