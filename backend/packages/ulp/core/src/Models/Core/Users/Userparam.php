<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

class Userparam extends \Ulp\Core\Models\Base {

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = ['value', 'type', ];

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}