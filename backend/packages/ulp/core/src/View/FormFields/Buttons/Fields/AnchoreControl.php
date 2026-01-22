<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Buttons\Fields;

class AnchoreControl extends \Ulp\Core\View\FormFields\Buttons\BaseButtonsField {

  protected string $routeName;
  public array $routeParams;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->routeName = $data['routeName'] ?? '';
    $this->routeParams = $data['routeParams'] ?? [];
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.button.anchore';
  }

}