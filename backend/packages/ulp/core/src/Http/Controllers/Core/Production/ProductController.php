<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Production;

use Ulp\Core\View\FormFields\Text\TextTypeController;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Products',
  group: 'Production',
  route: 'core.products.index',
)]

class ProductController extends \Ulp\Core\Http\Controllers\BaseCrudController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Production\Product::class;
  protected const ROUTE_NAME = 'core.products.';

  protected function titles(): array {
    return [
      'index' => 'Products Panel',
      'create' => 'Products Create Panel',
      'edit' => 'Products Edit Panel',
      'show' => 'Products Show Panel',
    ];
  }

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'unit_price', 'is_active','created_at', 'updated_at',
      ])->get(), 
      'labels' => [
        'Id', 'Name', 'Unit Price', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'unit_price' => true, 
        'is_active' => true, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function getFormFields(): array {
    return [

    ];
  }

}