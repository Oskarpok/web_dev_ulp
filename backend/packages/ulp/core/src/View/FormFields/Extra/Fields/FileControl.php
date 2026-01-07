<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Extra\Fields;

class FileControl extends \Ulp\Core\View\FormFields\Extra\BaseExtraField {

  public function __construct(array $data) {
    parent::__construct($data);
  }

  protected function resolveView(): string {
    return 'core::components.form_fields.extra.file';
  }

}