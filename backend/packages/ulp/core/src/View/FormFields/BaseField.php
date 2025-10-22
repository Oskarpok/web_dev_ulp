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
   * @var string Path to the Blade view corresponding to this field
   */
  protected string $view;

  /**
   * BaseField constructor
   * 
   * @param array $data Field configuration data (must include 'type')
   */
  public function __construct(array $data) {
    // Set the field type based on input data
    $this->type = $data['type'];  

    // Determine the view for the field by calling the abstract resolveView method
    $this->view = $this->resolveView();
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
   * Prepares the field data to pass to the view
   * By default, it returns all object properties as an array.
   * This method can be overridden in subclasses to add custom behavior for data.
   * 
   * @return array Data for the view
   */
  protected function viewData(): array {
    return get_object_vars($this);
  }

  /**
   * Renders the field as HTML
   * Calls the Blade view with the field data and returns the result as a string.
   * 
   * @return string HTML of the field
   */
  public function render(): string {
    return view($this->resolveView(), $this->viewData())->render();
  }

  /**
   * Getter for the field type
   * @return string Field type
   */
  public function getType() {
    return $this->type;
  }

}
