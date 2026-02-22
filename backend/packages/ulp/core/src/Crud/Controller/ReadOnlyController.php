<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;

abstract class ReadOnlyController extends \Illuminate\Routing\Controller {

  /**
   * This constant defines the Blade view namespace and directory prefix used 
   * when rendering CRUD (Create, Read, Update, Delete) components in the CORE.
   * 
   * @var string
   */
  protected const CRUD_VIEWS = 'core::components.crud_views.';

  /**
   * The fully qualified class name of the model associated with the controller.
   * This must be set overridden the child controller.
   * 
   * @var string
   */
  protected const MODEL_CLASS = null;

  /**
   * Route name for operations must be overridden in child controllers.
   * 
   * @var string
   */
  protected const RESOURCES_CLASS = null;

  /**
   * Route name for operations must be overridden in child controllers.
   * 
   * @var string
   */
  protected const ROUTE_NAME = null;

  /**
   * Return an array of vie index requaier data.
   *
   * @return array List of fields elements for the given controller.
   */
  abstract protected function indexTable(Request $request): array;

  /**
   * Return an array of title for views elements etc in controler.
   * 
   * @return array List of titles
   */
  abstract protected function titles(): array;

  /**
   * Prepares the data for the index view by calling the indexTable()
   * method with the current request, and then returns the corresponding
   * Blade view with the prepared data.
   *
   * @param \Illuminate\Http\Request $request  The incoming HTTP request.
   * @return \Illuminate\View\View  The rendered index view.
   */
  public function index(Request $request): View {
    $data = $this->indexTable($request);
    return view(self::CRUD_VIEWS . 'index', [
      'title' => $this->titles()['index'] ?? '',
      'buttons' => static::RESOURCES_CLASS::prepareIndexButtons(static::ROUTE_NAME),
      'table' => new \Ulp\Core\View\FormFields\Extra\Fields\IndexControl([
        'type' => 'intex',
        'labels' => $data['labels'],
        'filterable' => $data['filterable'],
        'data' => $data['data'],
        'destinations' => static::ROUTE_NAME,
        'resolveButtons' => ['show' => true],
      ]),
    ]);
  }

  /**
   * Displays the details of a single record.
   *
   * @param  int  $id  The ID of the record to display.
   * @return \Illuminate\Http\Response
   */
  public function show(int $id): View {
    $record = static::MODEL_CLASS::find($id);
    return view(self::CRUD_VIEWS . 'show', [
      'title' => $this->titles()['show'] ?? '',
      'buttons' => static::RESOURCES_CLASS::showButtons(static::ROUTE_NAME),
      'fields' => static::RESOURCES_CLASS::showFields($record),
      'route' => '#',
      'validationRules' => [],
      'data' => $record,
      'resourcesClass' => static::RESOURCES_CLASS,
    ]);
  }

}