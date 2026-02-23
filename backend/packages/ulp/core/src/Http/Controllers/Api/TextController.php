<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TextController extends \Ulp\Core\Crud\Controller\BaseApiController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Front\Text::class;
  
  public function getTranslations(Request $request) {
    return response()->json([
      'status' => 'success',
      'data' => self::MODEL_CLASS::with('translations.language')->get()->mapWithKeys(function ($text) {
        return [
          $text->name => $text->translations->mapWithKeys(function ($translation) {
            $shortcut = $translation->language->shortcut ?? 'unknown';
            return [$shortcut => $translation->translation];
          })
        ];
      })
    ]);
  }

}