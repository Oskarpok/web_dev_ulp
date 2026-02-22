<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Model\Traits;

trait IsActiveLabel {
  
  public function getIsActiveLabelAttribute(): string {
    return $this->getAttribute('is_active') ? 'Yes' : 'No';
  }
  
}