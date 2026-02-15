<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Media\Resources;

class ResourceCategoriesController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const LIVEWIER_CLASS = \Ulp\Core\Http\Resources\Core\Media\Resources\ResourceCategoriesResources::class;
  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Media\Resources\ResourceCategory::class;
  protected const ROUTE_NAME = 'core.resource_categories.';

  protected function titles(): array {
    return [
      'index' => 'Resources Category Panel',
      'create' => 'Resources Category Create Panel',
      'edit' => 'Resources Category Edit Panel',
      'show' => 'Resources Category Show Panel',
    ];
  }

  protected function indexTable(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'parent_id', 'is_active', 'created_at', 'updated_at',
      ])->paginate(30),
      'labels' => [
        'Id', 'Name', 'Parent', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'parent_id' => true, 
        'is_active' => false, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

}