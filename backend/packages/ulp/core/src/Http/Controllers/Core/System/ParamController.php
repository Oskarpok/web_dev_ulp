<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\System;

use Ulp\Core\Enums\ParamsType;
use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\Select\SelectTypeControl;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Parameters',
  group: 'Systemic',
  route: 'core.params.index',
)]

class ParamController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\System\Param::class;
  protected const ROUTE_NAME = 'core.params.';

  protected function titles(): array {
    return [
      'index' => 'Parameters Panel',
      'create' => 'Parameters Create Panel',
      'edit' => 'Parameters Edit Panel',
      'show' => 'Parameters Show Panel',
    ];
  }

  protected function indexTable(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'type', 'value', 'created_at', 'updated_at',
      ])->get(),
      'labels' => [
        'Id', 'Name', 'Type', 'Value', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'type' => true, 
        'value' => false, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function formFields(): array {
    return [
      
    ];
  }
  
}