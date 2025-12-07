<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Media\Resources;

class ResourceExtension extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'name', 'group', 'max_size', 'is_active',
  ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}