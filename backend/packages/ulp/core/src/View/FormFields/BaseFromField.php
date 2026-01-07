<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields;

/**
 * Abstract class BaseFromControl
 * The base class for pools used in the form and only by them should be inherited. 
 * Fields such as those from the Extra or Putton access don't need this, so 
 * they inherit directly from BaseControl because they don't need the following 
 * attributes. The auxiliary class was created for cleaner, better architecture.
 */
abstract class BaseFromField extends BaseField {

  protected string $name;
  protected string $label;
  protected string $tooltip;
  protected bool $readonly;
  protected bool $required;
  protected bool $disabled;
  protected string $wraper;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->name = $data['name'] ?? '';
    $this->label = $data['label'] ?? '';
    $this->tooltip = $data['tooltip'] ?? '';
    $this->fieldAttributes(
      $data['readonly'] ?? false,
      $data['required'] ?? false,
      $data['disabled'] ?? false,
    );
    $this->wraper = $data['wraper'] ?? 'mb-3 flex flex-col w-full md:w-[32%]';
  }

  protected function fieldAttributes(bool $readonly, bool $required, bool $disabled) {
    $type = $this->type;
    $map = [
      'readonly' => [
        'text', 'email', 'number', 'password', 'url', 'search', 
        'tel', 'date', 'datetime-local', 'time', 'textarea'
      ],
      'disabled' => [
        'text', 'email', 'number', 'password', 'url', 'search', 'tel', 'date', 
        'datetime-local', 'time', 'textarea', 'select', 'checkbox', 
        'radio', 'file', 'button', 'submit', 'reset'
      ],
      'required' => [
        'text', 'email', 'number', 'password', 'url', 'search', 'tel', 
        'date', 'datetime-local', 'time', 'textarea', 'select',' 
        checkbox', 'radio', 'file'
      ],
    ];

    $readonly && in_array($type, $map['readonly']) ? 
      $this->readonly = true : $this->readonly = false;

    $required && in_array($type, $map['required']) ? 
      $this->required = true : $this->required = false;
      
    $disabled && in_array($type, $map['disabled']) ? 
      $this->disabled = true : $this->disabled = false;
  }

  public function toLivewire(): array{
    return [
      ...get_object_vars($this),
      'view' => $this->resolveView(),
    ];
  }

}