<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Front;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Languages',
  group: 'Front',
  route: 'core.languages.index',
)]

class LanguagesController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Front\Language::class;
  protected const ROUTE_NAME = 'core.languages.';

  protected function titles(): array {
    return [
      'index' => 'Languages Panel',
      'create' => 'Languages Create Panel',
      'edit' => 'Languages Edit Panel',
      'show' => 'Languages Show Panel',
    ];
  }

  protected function indexTable(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'shortcut', 'is_active', 'created_at', 'updated_at',
      ])->paginate(30), 
      'labels' => [
        'Id', 'Name', 'Shortcut', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'shortcut' => true, 'is_active' => false,
        'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function formFields(): array {
    return [

    ];
  }
  
}