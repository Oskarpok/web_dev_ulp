<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Front;

class Text extends \Ulp\Core\Models\Base {

  protected $fillable = ['name'];

  public static function validationRules($id = null): array {
    return [
      'name' => ['required', 'string', 'max:255', ],
    ];
  }

  public function translations()  {
    return $this->hasMany(TextTranslation::class, 'text_id');
  }

}