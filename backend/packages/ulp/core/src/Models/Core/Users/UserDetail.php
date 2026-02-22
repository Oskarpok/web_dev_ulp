<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class UserDetail extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'user_id', 'first_name', 'sur_name', 'pesel', 'street', 'city', 'postcode', 
  ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}