<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Text\Fields;

class TextControl extends \Ulp\Core\View\FormFields\Text\BaseTextField {

  protected string $value;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = $data['value'] ?? '';
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.text.text';
  }
}