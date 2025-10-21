<?php

declare(strict_types=1);

namespace Ulp\Core\Models;

/**
 * Abstract base model providing common logic for CMS models.
 */
abstract class Base extends \Illuminate\Database\Eloquent\Model {

  use \Ulp\Core\Traits\DefaultModel;

  // public function __construct(array $attributes = []) {
  //   parent::__construct($attributes);
  //   $this->appends = [...$this->defaultAppends, ...$this->appends ?? []];
  //   // $this->fillable = [...$this->defaultFillable, ...$this->fillable ?? []];
  // }

}