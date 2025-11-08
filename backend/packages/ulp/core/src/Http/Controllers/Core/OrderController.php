<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core;
use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;

class OrderController extends \Ulp\Core\Http\Controllers\BaseController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Order::class;
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