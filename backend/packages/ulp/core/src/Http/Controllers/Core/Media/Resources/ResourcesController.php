<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Media\Resources;

use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;
use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Resources',
  group: 'Media',
  route: 'core.resources.index',
)]

class ResourcesController extends \Ulp\Core\Http\Controllers\BaseCrudController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Media\Resources\Resource::class;
  protected const ROUTE_NAME = 'core.resources.';

  protected function titles(): array {
    return [
      'index' => 'Resources Panel',
      'create' => 'Resources Create Panel',
      'edit' => 'Resources Edit Panel',
      'show' => 'Resources Show Panel',
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'alt', 'category_id', 'is_active', 'created_at', 'updated_at',
      ])->get(),
      'labels' => [
        'Id', 'Name', 'Alt', 'Category', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'alt' => false, 'category_id' => false,
        'is_active' => false, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function prepareIndexButtons(): array {
    return [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'route' => route('core.resources_extensions.index'),
        'label' => 'Resources Extensions',
        'icone' => 'fa-solid fa-file-signature',
      ]),
      ButtonsTypeController::make([
        'type' => 'anchore',
        'route' => route('core.resource_categories.index'),
        'label' => 'Resource Categories',
        'icone' => 'fa-solid fa-folder',
      ]),
      ...parent::prepareIndexButtons(),
    ];
  }

  protected function getFormFields($data = null): array {
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    $validationRules = self::MODEL_CLASS::validationRules();
    return [
      (function($currentRoute, $id) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return TextTypeController::make([
            'type' => 'number',
            'name' => 'id',
            'label' => 'ID',
            'value' => $id,
            'readonly' => true,
            'disabled' => true,
          ]);
        }
      })($currentRoute, $data?->id),
      (function($currentRoute, $name, $validationRule) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return TextTypeController::make([
            'type' => 'text',
            'name' => 'name',
            'label' => 'Name',
            'value' => $name,
            'required' => in_array('required', $validationRule),
            'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
              ? false : true,
          ]);
        }
      })($currentRoute, $data?->name, $validationRules['name']),
      TextTypeController::make([
        'type' => 'text',
        'name' => 'alt',
        'label' => 'Aternative',
        'value' => $data?->alt,
        'required' => in_array('required', $validationRules['alt']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),


      \Ulp\Core\View\FormFields\Extra\ExtraTypeController::make([
        'type' => 'file',
        'name' => 'file',
        'label' => 'File',
        'required' => true,
        'tooltip' => '',
        'disabled' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),


      \Ulp\Core\View\FormFields\Select\SelectTypeControl::make([
        'type' => 'checkbox',
        'name' => 'is_active',
        'label' => 'Active',
        'required' => in_array('required', $validationRules['is_active']),
        'value' => $data?->is_active,
        'disabled' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      (function($currentRoute, $created_at) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return DateTimeTypeControl::make([
            'type' => 'datetime-local',
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
            'type' => 'datetime-local',
            'name' => 'updated_at',
            'label' => 'Zaktualizowany',
            'readonly' => true,
            'value' => $updated_at,
          ]);
        }
      })($currentRoute, $data?->updated_at),
    ];
  }

}