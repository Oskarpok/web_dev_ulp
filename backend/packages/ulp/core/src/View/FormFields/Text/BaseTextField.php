<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Text;

abstract class BaseTextField extends \Ulp\Core\View\FormFields\BaseFromField {
  
  public function __construct(array $data) {
    parent::__construct($data);
  }

}