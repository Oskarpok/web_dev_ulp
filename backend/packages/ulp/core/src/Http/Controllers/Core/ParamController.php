<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ulp\Core\View\FormFields\Text\TextTypeController;

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

  protected function indexPrepare(Request $request): array {
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
    $currentRoute = Route::currentRouteName();
    $validationRules = self::MODEL_CLASS::validationRules();
    return [
      (function($currentRoute, $id) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return new TextTypeController([
            'type' => 'number',
            'name' => 'id',
            'label' => 'ID',
            'value' => $id,
            'readonly' => true,
          ]);
        }
      })($currentRoute, $data?->id),



    ];
  }
  
}