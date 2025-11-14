<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Front;

use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Texts',
  group: 'Front',
  route: 'core.texts.index',
  roles: [1,2,3],
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

  protected function getFormFields($data = null): array {
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    if($data) {
      $data->load('languages');
    }
    return [
      (function($currentRoute, $id) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return TextTypeController::make([
            'type' => 'number',
            'name' => 'id',
            'label' => 'ID',
            'value' => $id,
            'readonly' => true,
          ]);
        }
      })($currentRoute, $data?->id),
       TextTypeController::make([
        'type' => 'text',
        'name' => 'name',
        'label' => 'Nazwa',
        'value' => $data?->name,
        'required' => true,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      ...(function($data, $currentRoute) {
        $langs =  \Ulp\Core\Models\Core\Front\Language::where('is_active', true)
          ->pluck('name', 'id');

        if ($langs->isEmpty()) {
          return [];
        }

        foreach ($langs as $langId => $name) {
          $fields[] = TextTypeController::make([
            'type' => 'text_area',
            'name' => "translations[{$langId}]",
            'label' => "Tłumaczenie {$name}",
            'required' => true,
            'value' => $data?->languages
              ? $data->languages->firstWhere('id', $langId)?->pivot?->translation ?? ''
              : '',
            'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
              ? false : true,
          ]);
        }
        return $fields;
      })($data, $currentRoute),
      (function($currentRoute, $created_at) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return DateTimeTypeControl::make([
            'type' => 'date_time',
            'name' => 'created_at',
            'label' => 'Utworzony',
            'readonly' => true,
            'value' => $created_at,
          ]);
        }
      })($currentRoute, $data?->created_at),
      (function($currentRoute, $updated_at) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return DateTimeTypeControl::make([
            'type' => 'date_time',
            'name' => 'updated_at',
            'label' => 'Zaktualizowany',
            'readonly' => true,
            'value' => $updated_at,
          ]);
        }
      })($currentRoute, $data?->updated_at),
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