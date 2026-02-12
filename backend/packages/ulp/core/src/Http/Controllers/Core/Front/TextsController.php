<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Front;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Texts',
  group: 'Front',
  route: 'core.texts.index',
)]

class TextsController extends \Ulp\Core\Crud\Controller\BaseController {

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

  protected function indexTable(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'created_at', 'updated_at',
      ])->paginate(30), 
      'labels' => [
        'Id', 'Name', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function formFields(): array {
    return [
      //
    ];
  }

  protected function afterStore($record):void {
    if (!empty($record['translations'])) {                                       
      $record->languages()->attach(
        collect($record['translations'])
          ->map(fn($t) => ['translation' => $t])->toArray()                         
      );
    }
  }

  protected function afterUpdate($record):void {
    if (!empty($record['translations'])) {
      $record->languages()->sync(
        collect($record['translations'])
          ->map(fn($t) => ['translation' => $t])->toArray()
      );
    }
  }
  
}