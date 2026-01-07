<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Extra;

class ExtraTypeController extends \Ulp\Core\View\FormFields\BaseControl {

  protected static function controlMap(): array {
    return [
      'file' => Fields\FileControl::class,
      'intex' => Fields\IndexControl::class,
    ];
  }

}