<?php

declare(strict_types=1);

namespace Ulp\Core\View\FormFields\Components;

/**
 * Abstract class BaseField
 * Represents a basic form field.
 * Each field has a type, a view (Blade template), and data for rendering.
 */
abstract class Input {

  /**
   * @var string Field type (e.g., 'text', 'checkbox', 'select', 'anchore', etc.)
   */
  protected string $name;
  protected string $label;
  protected string $tooltip = '';
  protected string $wraper = 'mb-3 flex flex-col w-full md:w-[32%]';

  public function __construct(string $name) {
    $this->name = $name;
  }

  public static function make(string $name): static {
    return new static($name);
  }

  public function label(string $label): static {
    $this->label = $label;
    return $this;
  }

  public function tooltip(string $tooltip): static {
    $this->tooltip = $tooltip;
    return $this;
  }

  public function wraper(string $wraper): static {
    $this->wraper = $wraper;
    return $this;
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
  public function render(array $viewData = []): string {
    return view($this->resolveView(), $this->dataMerge($viewData))->render();
  }

  public function toLivewire(array $viewData = []): array{
    return [
      ...$this->dataMerge($viewData),
      'view' => $this->resolveView(),
    ];
  }

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