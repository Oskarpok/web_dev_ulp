<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Media\Resources;

class ResourceExtensionsController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const RESOURCES_CLASS = \Ulp\Core\Http\Resources\Core\Media\Resources\ResourceExtensionsResources::class;
  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Media\Resources\ResourceExtension::class;
  protected const ROUTE_NAME = 'core.resources_extensions.';

  protected function titles(): array {
    return [
      'index' => 'Resources Extension Panel',
      'create' => 'Resources Extension Create Panel',
      'edit' => 'Resources Extension Edit Panel',
      'show' => 'Resources Extension Show Panel',
    ];
  }

  protected function indexTable(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'group', 'max_size', 'is_active', 'created_at', 'updated_at',
      ])->paginate(30),
      'labels' => [
        'Id', 'Name', 'Group', 'Max Size', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'group' => true, 'max_size' => false, 
        'is_active' => false, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

}