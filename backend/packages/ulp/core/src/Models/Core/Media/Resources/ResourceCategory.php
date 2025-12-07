<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Media\Resources;

class ResourceCategory extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'name', 'parent_id', 'is_active',
  ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}