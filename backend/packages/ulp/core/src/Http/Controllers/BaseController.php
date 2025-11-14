<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers;

/**
 * Basic controller providing common logic for controllers
 */
abstract class BaseController extends \Illuminate\Routing\Controller {
  
  /**
   * This method checks whether a method with the given hook name exists in the 
   * current class. If it does, it will be executed with the provided parameters.
   *
   * @param string $hook   The name of the hook/method to call.
   * @param mixed  ...$params  Optional parameters to pass to the hook method.
   * @return void
   */
  protected function callHook(string $hook, ...$params): void {
    if (method_exists($this, $hook)) {
      $this->$hook(...$params);
    }
  }

}