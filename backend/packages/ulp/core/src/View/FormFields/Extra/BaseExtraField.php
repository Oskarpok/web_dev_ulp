<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Extra;

abstract class BaseExtraField extends \Ulp\Core\View\FormFields\BaseField {

  public function __construct(array $data) {
    parent::__construct($data);
  }

}