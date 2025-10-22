<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Extra;

class ExtraTypeController extends \Ulp\Core\View\FormFields\BaseControl {

  protected function controlMap(): array {
    return [
      'intex' => Fields\IndexControl::class,   
    ];
  }

}