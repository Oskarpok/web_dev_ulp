<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class Permission extends \Spatie\Permission\Models\Permission {

  use \Ulp\Core\Traits\DefaultModel;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name', 'guard_name', 'created_at', 'updated_at', 	
  ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}