<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\DateTime\Fields;

class DateTimeControl extends \Ulp\Core\View\FormFields\DateTime\BaseDateTimeField {

  protected ?string $value;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = is_object($data['value']) 
      ? $data['value']->format($data['format'] ?? $this->format)
      : $data['value'];
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.date_time.date_time';
  }

}