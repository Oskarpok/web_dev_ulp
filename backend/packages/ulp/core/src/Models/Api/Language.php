<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Api;

class Language extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'name', 'shortcut', 'is_active',
  ];

  public static function validationRules($id = null): array {
    return [
      'name' => ['required', 'string', 'max:255'],
      'shortcut' => ['required', 'string', 'max:10'],
      'is_active' => ['required', 'boolean'],
    ];
  }

  public function getIsActiveLabelAttribute(): string {
    return $this->getAttribute('is_active') ? 'Yes' : 'No';
  }

}