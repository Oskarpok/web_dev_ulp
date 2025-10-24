<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Buttons;

class ButtonsTypeController extends \Ulp\Core\View\FormFields\BaseControl {

  protected function controlMap(): array {
    return [
      'anchore' => Fields\AnchoreControl::class,
      'submit' => Fields\SubmitControl::class,
    ];
  }

}