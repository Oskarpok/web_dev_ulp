<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Front;

class TextTranslation extends \Ulp\Core\Models\Base {

  protected $fillable = ['translation', 'language_id', 'text_id'];

  public static function validationRules($id = null): array {
    return [
      'translation' => ['required', 'string', 'max:255', ],
    ];
  }

  public function language()  {
    return $this->belongsTo(Language::class, 'language_id');
  }

}