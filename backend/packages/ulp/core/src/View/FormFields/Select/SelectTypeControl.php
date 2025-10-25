<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Select;

class SelectTypeControl extends \Ulp\Core\View\FormFields\BaseControl {

  protected function controlMap(): array {
    return [
      'select' => Fields\SelectControl::class
    ];
  }

}