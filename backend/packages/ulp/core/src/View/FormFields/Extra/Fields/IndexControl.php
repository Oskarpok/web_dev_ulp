<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Extra\Fields;

class IndexControl extends \Ulp\Core\View\FormFields\BaseField {  

  protected array $labels;
  protected array $data;
  protected array $filterable;
  protected string $destinations;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->labels = $data['labels'];
    $this->data = $data['data'] 
      instanceof \Illuminate\Database\Eloquent\Collection
      ? $data['data']->toArray()
      : $data['data'];
    $this->filterable = $data['filterable'];
    $this->destinations = $data['destinations'];
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.extra.intex';
  }
  
}