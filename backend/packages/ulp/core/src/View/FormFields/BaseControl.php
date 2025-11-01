<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields;

/**
 * Abstract class BaseControl
 * Represents a wrapper or controller for form fields.
 * It resolves the actual field object based on the provided type,
 * and delegates rendering and type retrieval to that resolved field.
 */
abstract class BaseControl {

  /**
   * 
   */
  public static function make(array $data) {
    $map = static::controlMap();
    $type = $data['type'] ?? null;

    if (!$type || !isset($map[$type])) {
      throw new \InvalidArgumentException("Unknown field type: {$type}");
    }

    return new $map[$type]($data);
  }

  /**
   * Abstract method controlMap
   * Each subclass must implement this method and return a mapping of field types
   * to their corresponding classes.
   * 
   * @return array Mapping of field type => class name
   */
  abstract protected static function controlMap(): array;

}