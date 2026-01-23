<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Media\Resources;

use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

class ResourceCategoriesController extends \Ulp\Core\Http\Controllers\BaseCrudController {

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
      ])->get(),
      'labels' => [
        'Id', 'Name', 'Parent', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'parent_id' => true, 
        'is_active' => false, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function prepareIndexButtons(): array {
    return [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => 'core.resources.index',
        'label' => 'Resources',
        'icone' => 'fa-solid fa-file',
      ]),
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => 'core.resources_extensions.index',
        'label' => 'Resources Extensions',
        'icone' => 'fa-solid fa-file-signature',
      ]),
      ...parent::prepareIndexButtons(),
    ];
  }

  protected function formFields(): array {    
    return [

    ];
  }

}