<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Front;

class Text extends \Ulp\Core\Models\Base {

  protected $fillable = ['name',];

  public static function validationRules($id = null): array {
    return [
      'name' => ['required', 'string', 'max:255',
        \Illuminate\Validation\Rule::unique('texts', 'name')->ignore($id)],
      'translations.*' => ['nullable', 'string'],
    ];
  }

  public function languages() {
    return $this->belongsToMany(Language::class, 
      'text_translations', 'text_id', 'language_id')
      ->withPivot(['translation'])
      ->withTimestamps();
  }

}