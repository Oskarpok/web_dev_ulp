<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Front;

use Ulp\Core\Models\Core\Front\Language;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Texts',
  group: 'Front',
  route: 'core.texts.index',
)]

class TextsController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const RESOURCES_CLASS = \Ulp\Core\Http\Resources\Core\Front\TextsResources::class;
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

  protected function beforEdit($record): void {
    foreach ($record->translations as $t) {
      $record->{(string)$t->language_id} = $t->translation;
    }
  }

  protected function beforShow($record): void {
    foreach ($record->translations as $t) {
      $record->{(string)$t->language_id} = $t->translation;
    }
  }

  protected function afterStore($record, $request): void {
    foreach ($request->all() as $key => $value) {
      if(in_array((int)$key, 
        Language::where('is_active', true)->pluck('id')->toArray())) {
        $record->translations()->updateOrCreate(
          ['language_id' => (int)$key],
          ['translation' => $value],
        );
      }
    }
  }

  protected function afterUpdate(array &$validate, object $record, object $request): void {
    foreach ($request->all() as $key => $value) {
      if (in_array((int)$key, 
        Language::where('is_active', true)->pluck('id')->toArray())) {
        $record->translations()->updateOrCreate(
          ['language_id' => (int)$key],
          ['translation' => $value],
        );
      }
    }
  }
  
}