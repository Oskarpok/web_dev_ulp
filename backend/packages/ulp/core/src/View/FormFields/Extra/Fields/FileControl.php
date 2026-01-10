<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Extra\Fields;

class FileControl extends \Ulp\Core\View\FormFields\Extra\BaseExtraField {

  public string $accept;
  public bool $multiple;
  public int $max_size; // KB
  public string $store;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->accept = $data['accept'] ?? 'image';
    $this->multiple = $data['multiple'] ?? false;
    $this->max_size = $data['max_size'] ?? 2048;
    $this->store = $data['store'] ?? '';
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.extra.file';
  }

}