<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class UserParam extends \Ulp\Core\Models\Base {

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = ['user_id', 'value', 'type', ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}