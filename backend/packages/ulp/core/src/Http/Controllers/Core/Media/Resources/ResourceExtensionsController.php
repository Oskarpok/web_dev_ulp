<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Media\Resources;

use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

class ResourceExtensionsController extends \Ulp\Core\Http\Controllers\BaseCrudController {

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

  protected function indexPrepare(\Illuminate\Http\Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'group', 'max_size', 'is_active', 'created_at', 'updated_at',
      ])->get(),
      'labels' => [
        'Id', 'Name', 'Group', 'Max Size', 'Active', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'group' => true, 'max_size' => false, 
        'is_active' => false, 'created_at' => true, 'updated_at' => true,
      ],
    ];
  }

  protected function getFormFields($data, $currentRoute, $validationRules): array {
    return [

    ];
  }

  protected function prepareIndexButtons(): array {
    return [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'route' => route('core.resources.index'),
        'label' => 'Resources',
        'icone' => 'fa-solid fa-file',
      ]),
      ButtonsTypeController::make([
        'type' => 'anchore',
        'route' => route('core.resource_categories.index'),
        'label' => 'Resource Categories',
        'icone' => 'fa-solid fa-folder',
      ]),
      ...parent::prepareIndexButtons(),
    ];
  }

}