<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Resource;

use Ulp\Core\Crud\Concerns\CrudeMethods;
use Ulp\Core\Crud\Concerns\BaseCrudeFields;

abstract class BaseResource extends \Livewire\Component {

  use CrudeMethods, BaseCrudeFields;

  //
  abstract protected function table(): array;

  //
  abstract public static function pages(): array;

}