<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class CompanyDetail extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'user_id', 'company_name', 'street', 'city', 'postcode', 'nip', 'regon', 'krs',
  ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}