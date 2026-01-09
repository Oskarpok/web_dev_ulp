<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Media\Resources;

class Resource extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'name', 'alt', 'category_id', 'is_active',
  ];

  public static function validationRules($id = null): array {
    return [
      'name' => ['required', 'string', 'max:255',],
      'alt' => ['required', 'string', 'max:255',],
      'category_id' => ['required',],
      'is_active' => ['required', 'boolean'],
    ];
  }

}