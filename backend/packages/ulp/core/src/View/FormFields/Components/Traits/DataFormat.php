<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components\Traits;

trait DataFormat {

  protected string $format = 'Y-m-d\TH:i';

  public function format(string $format): static {
    $this->format = $format;
    return $this;
  }

}