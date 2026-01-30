<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Resource;

use Ulp\Core\Crud\Concerns\Model;
use Ulp\Core\Crud\Concerns\CrudViews;

abstract class BaseResource extends \Livewire\Component {

  use Model, CrudViews;

}