<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\DateTime;

abstract class BaseDateTimeField extends \Ulp\Core\View\FormFields\BaseFromField {

  protected string $format;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->format = $data['format'] ?? 'Y-m-d\TH:i';
  }

}