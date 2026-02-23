<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Api;

class TextController extends \Ulp\Core\Crud\Controller\BaseApiController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Front\Text::class;
  
  public function getTranslations() {
    $formatted = cache()->rememberForever('api_texts_dictionary', function () {
      return self::MODEL_CLASS::with('translations.language')->get()->mapWithKeys(function ($text) {
        return [
          $text->name => $text->translations->mapWithKeys(function ($translation) {
            $shortcut = $translation->language->shortcut ?? 'unknown';
            return [$shortcut => $translation->translation];
          })
        ];
      });
    });

    return response()->json([
      'status' => 'success',
      'data'   => $formatted
    ]);
  }

}