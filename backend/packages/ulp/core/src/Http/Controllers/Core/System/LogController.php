<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\System;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Logs',
  group: 'Systemic',
  route: 'core.logs.index',
)]

class LogController extends \Ulp\Core\Http\Controllers\BaseCrudController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\System\Log::class;
  protected const ROUTE_NAME = 'core.logs.';

  protected function titles(): array {
    return [
      'index' => 'Parameters Panel',
      'show' => 'Parameters Show Panel',
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'action', 'module_name', 'table_name', 'record_id', 'route', 'created_at',
      ])->get(),
      'labels' => [
        'Action', 'Module name', 'Table Name', 'Record Id', 'Route', 'Created At',
      ],
      'filterable' => [
        'action' => true, 'module_name' => true, 'route' => true,
        'table_name' => true, 'record_id' => true,  'created_at' => true,
      ],
    ];
  }

  protected function getFormFields(): array {
    return [
      //
    ];
  }

}