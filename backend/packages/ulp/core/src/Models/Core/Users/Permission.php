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
    //
  ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}