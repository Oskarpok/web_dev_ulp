<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Resources\Core\Front;

use Ulp\Core\Models\Core\Front\Language;
use Ulp\Core\View\FormFields\Components\TextInput;
use Ulp\Core\View\FormFields\Components\DateTimePicker;

class TextsResources extends \Ulp\Core\Crud\Resources\BaseResource {

  public static function createFields($data = null): array {
    return self::getTranslationFields();
  }

  public static function showFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      ...self::getTranslationFields(true),
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  public static function editFields($data = null): array {
    return [
      TextInput::make('id')->label('Id')->numeric()->readonly(),
      ...self::getTranslationFields(),
      DateTimePicker::make('created_at')->label('Created At')->readonly(),
      DateTimePicker::make('updated_at')->label('Updated At')->readonly(),
    ];
  }

  public static function getTranslationFields(bool $readonly = false): array {
    $fields = [
      TextInput::make('name')->label('Name')->required()->readonly($readonly)
    ];

    foreach(Language::where('is_active', true)
      ->pluck('name', 'id')->toArray() as $key => $lang) {
      $fields[] = TextInput::make((string)$key)->label($lang)
      ->required()->readonly($readonly);
    }
    
    return $fields;
  }

}