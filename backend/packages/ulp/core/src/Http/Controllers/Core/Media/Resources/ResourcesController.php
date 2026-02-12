<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Media\Resources;

use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Resources',
  group: 'Media',
  route: 'core.resources.index',
)]

class ResourcesController extends \Ulp\Core\Crud\Controller\BaseController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Media\Resources\Resource::class;
  protected const ROUTE_NAME = 'core.resources.';

  protected function titles(): array {
    return [
      'index' => 'Resources Panel',
      'create' => 'Resources Create Panel',
      'edit' => 'Resources Edit Panel',
      'show' => 'Resources Show Panel',
    ];
  }

  protected function indexTable(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'alt', 'category_id', 'is_active', 'created_at', 'updated_at',
      ])->paginate(30),
      'labels' => [
        'Id', 'Name', 'Alt', 'Category', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'alt' => false, 'category_id' => false,
        'is_active' => false, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function prepareIndexButtons(): array {
    return [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => 'core.resources_extensions.index',
        'label' => 'Resources Extensions',
        'icone' => 'fa-solid fa-file-signature',
      ]),
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => 'core.resource_categories.index',
        'label' => 'Resource Categories',
        'icone' => 'fa-solid fa-folder',
      ]),
      ...parent::prepareIndexButtons(),
    ];
  }

}