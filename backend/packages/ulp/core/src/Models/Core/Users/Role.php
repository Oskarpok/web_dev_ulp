<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class Role extends \Spatie\Permission\Models\Role {

  use \Ulp\Core\Crud\Model\DefaultModel;

  protected $fillable = ['name', 'guard_name', 'details_table', ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}