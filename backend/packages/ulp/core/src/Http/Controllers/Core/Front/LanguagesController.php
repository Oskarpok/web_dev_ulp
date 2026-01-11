<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Front;

use Ulp\Core\View\FormFields\Text\TextTypeController;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Languages',
  group: 'Front',
  route: 'core.languages.index',
)]

class LanguagesController extends \Ulp\Core\Http\Controllers\BaseCrudController {

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

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'shortcut', 'is_active', 'created_at', 'updated_at',
      ])->get(), 
      'labels' => [
        'Id', 'Name', 'Shortcut', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'shortcut' => true, 'is_active' => false,
        'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function getFormFields($data, $currentRoute, $validationRules): array {
    return [
      TextTypeController::make([
        'type' => 'text',
        'name' => 'name',
        'label' => 'Nazwa',
        'value' => $data?->name,
        'required' => in_array('required', $validationRules['name']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      TextTypeController::make([
        'type' => 'text',
        'name' => 'shortcut',
        'label' => 'Shortcut',
        'value' => $data?->shortcut,
        'required' => in_array('required', $validationRules['shortcut']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      \Ulp\Core\View\FormFields\Select\SelectTypeControl::make([
        'type' => 'checkbox',
        'name' => 'is_active',
        'label' => 'Active',
        'required' => true,
        'value' => $data?->is_active,
        'disabled' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
    ];
  }
  
}