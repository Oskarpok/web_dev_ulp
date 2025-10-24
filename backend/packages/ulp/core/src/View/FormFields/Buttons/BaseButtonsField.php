<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Buttons;

abstract class BaseButtonsField extends \Ulp\Core\View\FormFields\BaseField {

  protected int $style;
  protected string $name;
  protected string $label;
  protected string $icone;
  protected bool $readonly;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->style = $data['style'] ?? 0;
    $this->name = $data['name'] ?? '';
    $this->label = $data['label'] ?? '';
    $this->icone = $data['icone'] ?? '';
    $this->readonly = $data['readonly'] ?? false;
  }

}