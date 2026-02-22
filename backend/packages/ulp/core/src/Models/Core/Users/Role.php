<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class Role extends \Spatie\Permission\Models\Role {

  use \Ulp\Core\Traits\DefaultModel;

  protected $fillable = ['name', 'guard_name', 'details_table', ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}