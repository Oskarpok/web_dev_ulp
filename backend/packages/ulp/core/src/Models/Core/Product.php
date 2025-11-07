<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core;

class Product extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'name', 'unit_price', 'is_active', 'specification', 'description',
  ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}