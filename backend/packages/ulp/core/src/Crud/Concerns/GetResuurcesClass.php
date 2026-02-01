<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Concerns;

trait GetResuurcesClass {

  protected function getResourceClass(): string {
    $namespace = (new \ReflectionClass($this))->getNamespaceName();
    return $namespace . '\\' . collect(explode('\\', $namespace))->last();
  }

}