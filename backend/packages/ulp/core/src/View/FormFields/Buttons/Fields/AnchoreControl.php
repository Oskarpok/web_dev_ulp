<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Buttons\Fields;

class AnchoreControl extends \Ulp\Core\View\FormFields\Buttons\BaseButtonsField {

  protected string $route;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->route = $data['route'];
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.core_button.anchore';
  }

}