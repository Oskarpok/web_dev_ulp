<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Concerns;
  
trait CrudViews {

  /**
   * This constant defines the Blade view namespace and directory prefix used 
   * when rendering CRUD (Create, Read, Update, Delete) components in the CORE.
   * 
   * @var string
   */
  protected const CRUD_VIEWS = 'core::components.crud_views.';

}
