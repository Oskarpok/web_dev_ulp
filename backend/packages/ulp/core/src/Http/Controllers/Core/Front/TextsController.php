<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Front;

use Ulp\Core\View\FormFields\Text\TextTypeController;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Texts',
  group: 'Front',
  route: 'core.texts.index',
)]

class TextsController extends \Ulp\Core\Http\Controllers\BaseCrudController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Front\Text::class;
  protected const ROUTE_NAME = 'core.texts.';

  protected function titles(): array {
    return [
      'index' => 'Texts Panel',
      'create' => 'Texts Create Panel',
      'edit' => 'Texts Edit Panel',
      'show' => 'Texts Show Panel',
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'created_at', 'updated_at',
      ])->get(), 
      'labels' => [
        'Id', 'Name', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function getFormFields(): array {
   
    return [
    ];
  }

  protected function afterStore($validated, $record) {
    if (!empty($validated['translations'])) {                                       
      $record->languages()->attach(
        collect($validated['translations'])
          ->map(fn($t) => ['translation' => $t])->toArray()                         
      );
    }
  }

  protected function afterUpdate($validated, $record) {
    if (!empty($validated['translations'])) {
      $record->languages()->sync(
        collect($validated['translations'])
          ->map(fn($t) => ['translation' => $t])->toArray()
      );
    }
  }
  
}