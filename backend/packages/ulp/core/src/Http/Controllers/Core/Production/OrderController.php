<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Production;

use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Orders',
  group: 'Production',
  route: 'core.orders.index',
)]

class OrderController extends \Ulp\Core\Http\Controllers\BaseCrudController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Production\Order::class;
  protected const ROUTE_NAME = 'core.orders.';

  protected function titles(): array {
    return [
      'index' => 'Orders Panel',
      'create' => 'Orders Create Panel',
      'edit' => 'Orders Edit Panel',
      'show' => 'Orders Show Panel',
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'user_id', 'price', 'status', 'parcel_number',  
        'created_at', 'updated_at',
      ])->get(), 
      'labels' => [
        'Id', 'user_id', 'price', 'status', 'parcel_number', 
        'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'user_id' => true, 'price' => false, 'status' => false,
        'parcel_number' => true, 'created_at' => true, 'updated_at' => true,
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
        'name' => 'parcel_number',
        'label' => 'Parcel Number',
        'value' => $data?->parcel_number,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      TextTypeController::make([
        'type' => 'text_area',
        'name' => 'notes',
        'label' => 'Notes',
        'value' => $data?->notes,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),

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