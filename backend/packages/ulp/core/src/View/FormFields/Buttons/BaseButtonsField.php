<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Buttons;

abstract class BaseButtonsField extends \Ulp\Core\View\FormFields\BaseField {

  protected string $style;
  protected string $name;
  protected string $label;
  protected string $icone;
  protected bool $readonly;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->style = $this->resolveStyle($data['style'] ?? 0);
    $this->name = $data['name'] ?? '';
    $this->label = $data['label'] ?? '';
    $this->icone = $data['icone'] ?? '';
    $this->readonly = $data['readonly'] ?? false;
  }

  public function resolveStyle(int $style) {
    return match ($style) {
      0 => 'core-btn-primary',
      1 => 'core-btn-secondary',
      2 => 'core-btn-background',
      3 => 'core-btn-outline',
      default => 'core-btn-primary',
    };
  }

}