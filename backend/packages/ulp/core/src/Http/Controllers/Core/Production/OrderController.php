<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Production;

use Ulp\Core\View\FormFields\Text\TextTypeController;

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

  protected function indexTable(\Illuminate\Http\Request $request): array {
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

  protected function formFields(): array {
    return [

    ];
  }

}