<?php
 
namespace Ulp\Core\Crud\Resources;

abstract class BaseResource {

  protected const ROUTE_NAME = null;

  /**
   * @return array List of fields for database record.
   */
  abstract public static function createButtons(): array;
  abstract public static function createFields(): array;
  abstract public static function showButtons(): array;
  abstract public static function showFields(): array;
  abstract public static function editButtons(): array;
  abstract public static function editFields(): array;

}