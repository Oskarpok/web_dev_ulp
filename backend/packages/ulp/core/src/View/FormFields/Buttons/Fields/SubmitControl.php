<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Buttons\Fields;

class SubmitControl extends \Ulp\Core\View\FormFields\Buttons\BaseButtonsField {

  public function __construct(array $data) {
    parent::__construct($data);
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.core_button.submit';
  }
  
}