<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

use Ulp\Core\View\FormFields\Components\Traits\BeDisabled;
use Ulp\Core\View\FormFields\Components\Traits\BeRequired;
use Ulp\Core\View\FormFields\Components\Traits\BeReactive;

class Select extends Input {

  use BeDisabled, BeRequired, BeReactive;

  protected string $type = 'select';
  protected array $options = [];
  protected bool $searchable = false;
  protected bool $multiple = false;
  protected string $view = 'core::components.form_fields.select.select';

  public function value($value){
    $this->value = $value;  
    return $this;
  }

  public function multiple(bool $is_multiple = true){
    $this->multiple = $is_multiple;  
    return $this;
  }

  public function searchable(bool $is_searchable = true){
    $this->searchable = $is_searchable;  
    return $this;
  }

  public function options(array $options){
    $this->options = $options;  
    return $this;
  }

}