<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Controller;

use Ulp\Core\Crud\Concerns\Model;
use Ulp\Core\Crud\Concerns\CrudViews;

abstract class BaseController extends \Illuminate\Routing\Controller {

  use Model, CrudViews;

}