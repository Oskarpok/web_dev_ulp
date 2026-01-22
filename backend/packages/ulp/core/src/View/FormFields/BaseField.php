<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields;

/**
 * Abstract class BaseField
 * Represents a basic form field.
 * Each field has a type, a view (Blade template), and data for rendering.
 */
abstract class BaseField {

  /**
   * @var string Field type (e.g., 'text', 'checkbox', 'select', 'anchore', etc.)
   */
  protected string $type;

  /**
   * BaseField constructor
   * 
   * @param array $data Field configuration data (must include 'type')
   */
  public function __construct(array $data) {
    $this->type = $data['type'];  
  }

  /**
   * Getter for the field atributes
   * @return atributes of field
   */
  public function __get($key) {
    return $this->$key ?? null;
  }

  /**
   * Abstract method resolveView
   * Each subclass must implement this method and return the Blade view name 
   * for the field.
   * 
   * @return string Blade view path
   */
  abstract protected function resolveView(): string;

  /**
   * Renders the field as HTML
   * Calls the Blade view with the field data and returns the result as a string.
   * 
   * @return string HTML of the field
   */
  public function render(array $data = []): string {
    return view($this->resolveView(), get_object_vars($this) + $data)->render();
  }

}