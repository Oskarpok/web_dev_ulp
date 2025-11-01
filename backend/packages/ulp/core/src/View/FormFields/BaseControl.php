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
   * @var BaseField The resolved field object
   */
  protected $resolved;

  /**
   * BaseControl constructor
   * 
   * @param array $data Field configuration data (must include 'type')
   * Resolves the actual field object using the controlMap.
   */
  public function __construct(array $data) {
    $this->resolved = $this->resolveField($data);
  }

  /**
   * Abstract method controlMap
   * Each subclass must implement this method and return a mapping of field types
   * to their corresponding classes.
   * 
   * @return array Mapping of field type => class name
   */
  abstract protected function controlMap(): array;

  /**
   * Resolves the actual field object based on type
   * Looks up the class in the controlMap and creates a new instance of it.
   * 
   * @param array $data Field configuration data
   * @return BaseField Resolved field object
   */
  protected function resolveField(array $data) {
    return new ($this->controlMap()[$data['type']])($data);
  }

  /**
   * Renders the resolved field
   * Delegates the rendering to the resolved field object.
   * 
   * @return string HTML of the field
   */
  public function render(): string {
    return $this->resolved->render();
  }

  /**
   * Gets the type of the resolved field
   * Delegates to the resolved field's getType() method.
   * 
   * @return string Field type
   */
  public function getType(): string {
    return $this->resolved->type;
  }

}
