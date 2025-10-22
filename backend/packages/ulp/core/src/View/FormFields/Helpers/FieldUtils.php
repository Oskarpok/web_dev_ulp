<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Helpers;

final class FieldUtils {
  /**
   * Checks if among the given controls exists one with the specified type.
   *
   * @param array<BaseControl> $controls
   * @param string $type
   * @return bool
   */
  public static function hasType(array $controls, string $type): bool {
    foreach ($controls as $control) {
        if ($control?->getType() === $type) {
            return true;
        }
    }
    return false;
  }
}
