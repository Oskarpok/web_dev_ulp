<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers;

/**
 * Basic controller providing common logic for Core CRUD type controllers
 * Allows child controllers to define a model class and Ulp\Core 
 * handle basic CRUD operations
 */
abstract class BaseCrudController extends BaseController {
  
  use \Ulp\Core\Traits\DefaultController;

}