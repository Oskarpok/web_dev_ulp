<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Text\Fields;

class NumberControl extends \Ulp\Core\View\FormFields\Text\BaseTextField {

  protected int|float|null $value;
  protected int|float $step;
  protected int|float $max;
  protected int|float $min;
  protected bool $allow_float;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = $data['value'] ?? null;
    $this->step = $data['step'] ?? 1;
    $this->max = $data['max'] ?? 1000000000;
    $this->min = $data['min'] ?? -1000000000;
    $this->allow_float = $data['allow_float'] ?? false;
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.text.number';
  }

}