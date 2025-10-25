<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Text;

class TextTypeController extends \Ulp\Core\View\FormFields\BaseControl {

  protected function controlMap(): array {
    return [
      // 'text' => Fields\TextControl::class,
      'number' => Fields\NumberControl::class,
    ];
  }

}