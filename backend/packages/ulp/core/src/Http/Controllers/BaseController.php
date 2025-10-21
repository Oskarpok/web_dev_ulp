<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers;

/**
 * Basic controller providing common logic for CMS controllers
 * Allows child controllers to define a model class and Ulp\Core
 * handle basic CRUD operations
 */
abstract class BaseController extends \Illuminate\Routing\Controller {
  
  use \Ulp\Core\Traits\DefaultController;

}