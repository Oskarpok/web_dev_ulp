<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core;

use Ulp\Core\Enums\ParamsType;
use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\Select\SelectTypeControl;
use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Parametry',
  group: 'Systemowe',
  route: 'core.params.index',
  roles: [1,2,],
)]

class ParamController extends \Ulp\Core\Http\Controllers\BaseController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Param::class;
  protected const ROUTE_NAME = 'core.params.';

  protected function titles(): array {
    return [
      'index' => 'Parameters Panel',
      'create' => 'Parameters Create Panel',
      'edit' => 'Parameters Edit Panel',
      'show' => 'Parameters Show Panel',
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'type', 'value', 'created_at', 'updated_at',
      ])->get()->append(['type_label', 'value']), 
      'labels' => [
        'Id', 'Name', 'Type', 'Value', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'type' => true, 
        'value' => false, 'created_at' => true, 'updated_at' => true,
      ],
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
          ]);
        }
      })($currentRoute, $data?->id),
      TextTypeController::make([
        'type' => 'text',
        'name' => 'name',
        'label' => 'Nazwa',
        'value' => $data?->name,
        'required' => in_array('required', $validationRules['name']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      SelectTypeControl::make([
        'type' => 'select',
        'name' => 'type',
        'label' => 'Type',
        'options' => ParamsType::toArray() ?? [],
        'required' => in_array('required', $validationRules['type']),
        'value' => $data?->type,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      (function($data, $currentRoute) {
        return match ($data?->type) {
          1 => TextTypeController::make([
            'type' => 'number',
            'name' => 'val_int',
            'label' => 'Value',
            'value' => $data?->val_int,
            'required' => true,
            'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
              ? false : true,
          ]),
          2 => TextTypeController::make([
            'type' => 'number',
            'name' => 'val_float',
            'label' => 'Value',
            'value' => $data?->val_float,
            'allow_float' => true,
            'required' => true,
            'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
              ? false : true,
          ]),
          4 => SelectTypeControl::make([
            'type' => 'checkbox',
            'name' => 'val_bool',
            'label' => 'Value',
            'required' => true,
            'value' => $data?->val_bool,
            'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
              ? false : true,
          ]),
          5 => TextTypeController::make([
            'type' => 'text_area',
            'name' => 'val_json',
            'label' => 'Value',
            'required' => true,
            'value' => $data?->val_json,
            'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
              ? false : true,
          ]),
          default => TextTypeController::make([
            'type' => 'text',
            'name' => 'val_string',
            'label' => 'Value',
            'value' => $data?->val_string,
            'required' => true,
            'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
              ? false : true,
          ]),
        };
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
  
}