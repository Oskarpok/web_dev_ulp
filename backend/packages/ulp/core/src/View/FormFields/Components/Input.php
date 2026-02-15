<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

/**
 * Abstract class Input represents a basic form field.
 * Each field has field data for rendering and view (Blade template for render).
 */
abstract class Input {

  /**
   * Base atributes of all form fields class
   */
  protected string $type;
  protected string $name;
  protected string $label;
  protected mixed $value = null;
  protected string $tooltip = '';
  protected string $view = '';
  protected string $wraper = 'mb-3 flex flex-col w-full md:w-[32%]';

  /**
   * Init form fields object and set its name
   */
  public function __construct(string $name) {
    $this->name = $name;
  }

  /**
   * Method to create intance of form field
   * 
   * @return object of new form field
   */
  public static function make(string $name): static {
    return new static($name);
  }

  /**
   * Method to set type for field object
   * 
   * @return object of form field
   */
  public function type(string $type): static {
    $this->type = $type;
    return $this;
  }

  /**
   * Method to set label for field object
   * 
   * @return object of form field
   */
  public function label(string $label): static {
    $this->label = $label;
    return $this;
  }

  /**
   * Method to set tooltip for field
   * 
   * @return object of form field
   */
  public function tooltip(string $tooltip): static {
    $this->tooltip = $tooltip;
    return $this;
  }

  /**
   * Method to set wraper for field
   * 
   * @return object of form field
   */
  public function wraper(string $wraper): static {
    $this->wraper = $wraper;
    return $this;
  }

  /**
   * Getter for the field atributes
   * 
   * @return atributes of field
   */
  public function __get($key) {
    return $this->$key ?? null;
  }

  /**
   * 
   */
  abstract public function value($value);

  /**
   * Renders the field as HTML
   * Calls the Blade view with the field data and returns the result as a string.
   * 
   * @return string HTML of the field
   */
  public function render(array $viewData = []): string {
    return view($this->view, $this->dataMerge($viewData))->render();
  }

  /**
   * Get merge data from class and viev if data is given om viev
   * 
   * @return array of merge properties
   */
  protected function dataMerge($viewData) {
    $classData = get_object_vars($this);

    foreach ($viewData as $key => $value) {
      if (array_key_exists($key, $classData)) {
        $classData[$key] = $value;
      }
    }

    return $classData;
  }

}