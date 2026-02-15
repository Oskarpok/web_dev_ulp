<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Production;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Products',
  group: 'Production',
  route: 'core.products.index',
)]

class ProductController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const RESOURCES_CLASS = \Ulp\Core\Http\Resources\Core\Production\ProductResources::class;
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

  protected function indexTable(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'unit_price', 'is_active','created_at', 'updated_at',
      ])->paginate(30), 
      'labels' => [
        'Id', 'Name', 'Unit Price', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'unit_price' => true, 
        'is_active' => true, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

}