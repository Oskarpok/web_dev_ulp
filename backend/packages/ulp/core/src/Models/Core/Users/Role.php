<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class Role extends \Spatie\Permission\Models\Role {

  use \Ulp\Core\Traits\DefaultModel;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = ['name', 'guard_name', 'details_table', ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}