<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\DateTime;

class DateTimeTypeControl extends \Ulp\Core\View\FormFields\BaseControl {

  protected function controlMap(): array {
    return [
      'date_time' => Fields\DateTimeControl::class,
    ];
  }

}