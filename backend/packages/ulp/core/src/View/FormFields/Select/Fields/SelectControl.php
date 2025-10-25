<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Select\Fields;

class SelectControl extends \Ulp\Core\View\FormFields\Select\BaseSelectField {

  protected string|int $value;
  protected array $options;
  protected bool $searchable;
  protected bool $multiple;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = $data['value'] ?? '';
    $this->multiple = $data['multiple'] ?? false;
    $this->searchable = $data['searchable'] ?? false;
    $this->options = $data['options'] ?? [];
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.select.select';
  }
  
}