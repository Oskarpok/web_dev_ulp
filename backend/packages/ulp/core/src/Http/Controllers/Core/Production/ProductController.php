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

  protected function getFormFields($data, $currentRoute, $validationRules): array {
    return [
      TextTypeController::make([
        'type' => 'text',
        'name' => 'name',
        'label' => 'Nazwa',
        'value' => $data?->name,
        'required' => in_array('required', $validationRules['name']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      TextTypeController::make([
        'type' => 'number',
        'name' => 'unit_price',
        'label' => 'Unit Price',
        'value' => $data?->unit_price,
        'allow_float' => true,
        'required' => in_array('required', $validationRules['unit_price']),
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
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
      TextTypeController::make([
        'type' => 'text_area',
        'name' => 'specification',
        'label' => 'Specification',
        'required' => in_array('required', $validationRules['specification']),
        'value' => $data?->specification,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      TextTypeController::make([
        'type' => 'text_area',
        'name' => 'description',
        'label' => 'Description',
        'required' => in_array('required', $validationRules['description']),
        'value' => $data?->description,
        'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
          ? false : true,
      ]),
      //file
    ];
  }

}