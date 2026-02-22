<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class SystemUserDetail extends \Ulp\Core\Models\Base {

  protected $fillable = ['user_id', 'first_name', 'sur_name', 'pesel', ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}