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
  protected string $tooltip; // To implemnt Iplement in blade 
  protected bool $readonly;
  protected bool $required;
  protected string $wraper;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->name = $data['name'] ?? '';
    $this->label = $data['label'] ?? '';
    $this->tooltip = $data['tooltip'] ?? '';
    $this->readonly = $data['readonly'] ?? false;
    $this->required = $data['required'] ?? false;
    $this->wraper = $data['wraper'] ?? 'flex flex-col w-full md:w-[32%]';
  }

}