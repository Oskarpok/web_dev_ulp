<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Buttons\Fields;

class SubmitControl extends \Ulp\Core\View\FormFields\Buttons\BaseButtonsField {

  protected string $formn;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->formn = $data['form'] ?? 'form';
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.button.submit';
  }
  
}