<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ulp\Core\View\FormFields\Text\TextTypeController;
use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;
use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;

class ParamController extends \Ulp\Core\Http\Controllers\BaseController {

  protected const MODEL_CLASS = \Ulp\Core\Models\Core\Param::class;
  protected const ROUTE_NAME = 'core.params.';

  protected function titles(): array {
    return [
      'index' => 'Parameters Panel',
      'create' => 'Parameters Create Panel',
      'edit' => 'Parameters Edit Panel',
      'show' => 'Parameters Show Panel',
    ];
  }

  protected function indexPrepare(Request $request): array {
    return [
      'data' => self::MODEL_CLASS::filter($request, [
        'id', 'name', 'type', 'value', 'created_at', 'updated_at',
      ])->get()->append(['type_label', 'value']), 
      'labels' => [
        'Id', 'Name', 'Type', 'Value', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'type' => true, 'value' => false, 
        'created_at' => true, 'updated_at' => true,
      ], 
      'destinations' => self::ROUTE_NAME,
      'buttons' => [
        // new ButtonsTypeController([
        //   'type' => 'anchore',
        //   'route' => route(self::ROUTE_NAME . 'create'),
        //   'label' => 'Dodaj parametr',
        //   'icone' => 'fa-solid fa-plus',
        // ]),
      ],
    ];
  }

  protected function prepareFormFields($data = null): array {
    $currentRoute = Route::currentRouteName();
    $validationRules = self::MODEL_CLASS::validationRules();
    return [
      // 'fields' => [
      //   (function($currentRoute, $id) {
      //     if($currentRoute !== self::ROUTE_NAME . 'create') {
      //       return new TextTypeController([
      //         'type' => 'number',
      //         'name' => 'id',
      //         'label' => 'ID',
      //         'value' => $id,
      //         'readonly' => true,
      //       ]);
      //     }
      //   })($currentRoute, $data?->id),
      //   new TextTypeController([
      //     'type' => 'text',
      //     'name' => 'name',
      //     'label' => 'Nazwa',
      //     'value' => $data?->name,
      //     'required' => true,
      //     'validation' => $validationRules['name'],
      //     'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
      //       ? false : true,
      //   ]),
      //   new \Ulp\Core\View\FormFields\Select\SelectTypeControl([
      //     'type' => 'select',
      //     'name' => 'type',
      //     'label' => 'Type',
      //     'options' => \Ulp\Core\Enums\ParamsType::toArray() ?? [],
      //     'required' => true,
      //     'value' => $data?->type,
      //     'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
      //       ? false : true,
      //   ]),


      //   // value

      //   (function($currentRoute, $created_at) {
      //     if($currentRoute !== self::ROUTE_NAME . 'create') {
      //       return new DateTimeTypeControl([
      //         'type' => 'date_time',
      //         'name' => 'created_at',
      //         'label' => 'Utworzony',
      //         'readonly' => true,
      //         'value' => $created_at,
      //       ]);
      //     }
      //   })($currentRoute, $data?->created_at),
      //   (function($currentRoute, $updated_at) {
      //     if($currentRoute !== self::ROUTE_NAME . 'create') {
      //       return new DateTimeTypeControl([
      //         'type' => 'date_time',
      //         'name' => 'updated_at',
      //         'label' => 'Zaktualizowany',
      //         'readonly' => true,
      //         'value' => $updated_at,
      //       ]);
      //     }
      //   })($currentRoute, $data?->updated_at),
      // ],
      // 'buttons' => [
      //   (function($currentRoute) {
      //     if ($currentRoute !== self::ROUTE_NAME . 'show') {
      //       return new ButtonsTypeController([
      //         'type' => 'submit',
      //         'label' => 'Zapisz',
      //         'icone' => 'fa-solid fa-file',
      //       ]);
      //     }
      //   })($currentRoute),
      //   new ButtonsTypeController([
      //     'type' => 'anchore',
      //     'route' => route(self::ROUTE_NAME . 'index'),
      //     'label' => 'Powrut',
      //     'icone' => 'fa-solid fa-arrow-left',
      //   ]),
      // ]
    ];
  }

}