<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

abstract class BaseController extends \Illuminate\Routing\Controller {

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
  protected const LIVEWIER_CLASS = null;

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
   * Punkty wejścia (Hooks) - puste metody, które dzieci mogą nadpisać.
   */
  protected function beforeValidation(object &$data): void {}
  protected function afterValidation(object &$data): void {}
  protected function beforeStore(array &$data): void {}
  protected function afterStore(object $record): void {}
  protected function beforeUpdate(array $validate, object $record): void {}
  protected function afterUpdate(object $record): void {}
  protected function beforeDestroy(object $record): void {}
  protected function afterDestroy(object $record): void {}

  //
  public function heckRowButtonsAcces($destination): array {
    return [
      'show' => Route::has($destination . 'show'),
      'edit' => Route::has($destination . 'edit'),
      'destroy' => Route::has($destination . 'destroy'),
    ];
  }

  /**
   * Prepares the data for the index view by calling the indexTable()
   * method with the current request, and then returns the corresponding
   * Blade view with the prepared data.
   *
   * @param \Illuminate\Http\Request $request  The incoming HTTP request.
   * @return \Illuminate\View\View  The rendered index view.
   */
  public function index(Request $request): \Illuminate\View\View {
    $data = $this->indexTable($request);
    return view(self::CRUD_VIEWS . 'index', [
      'title' => $this->titles()['index'] ?? '',
      'buttons' => static::LIVEWIER_CLASS::prepareIndexButtons(),
      'table' => new \Ulp\Core\View\FormFields\Extra\Fields\IndexControl([
        'type' => 'intex',
        'labels' => $data['labels'],
        'filterable' => $data['filterable'],
        'data' => $data['data'],
        'destinations' => static::ROUTE_NAME,
        'resolveButtons' => $this->heckRowButtonsAcces(static::ROUTE_NAME),
      ]),
    ]);
  }

  /**
   * Displays the form view for creating a new record.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(): \Illuminate\View\View {
    return view(self::CRUD_VIEWS . 'create', [
      'title' => $this->titles()['create'] ?? '',
      'buttons' => static::LIVEWIER_CLASS::createButtons(),
      'fields' => static::LIVEWIER_CLASS::createFields(),
      'route' => route(static::ROUTE_NAME . 'store'),
      'validationRules' => static::MODEL_CLASS::validationRules(),
      'data' => [],
    ]);
  }

  /**
   * Handles storing a new record.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request) {
    $this->beforeValidation($request);
    $validate =  $request->validate(static::MODEL_CLASS::validationRules());   
    $this->afterValidation($request);
    $this->beforeStore($validate);
    $this->afterStore(static::MODEL_CLASS::create($validate));
    return redirect()->route(static::ROUTE_NAME . 'index')
      ->with('success', $this->titles()['recordCreatedSucces'] 
      ?? 'Record has been updated');
  }

  /**
   * Displays the details of a single record.
   *
   * @param  int  $id  The ID of the record to display.
   * @return \Illuminate\Http\Response
   */
  public function show(int $id): \Illuminate\View\View {
    return view(self::CRUD_VIEWS . 'show', [
      'title' => $this->titles()['show'] ?? '',
      'buttons' => static::LIVEWIER_CLASS::showButtons(),
      'fields' => static::LIVEWIER_CLASS::showFields(),
      'route' => '#',
      'validationRules' => [],
      'data' => static::MODEL_CLASS::find($id),
    ]);
  }

  /**
   * Displays a form for editing an existing record.
   *
   * @param  int  $id  The ID of the record to be edited.
   * @return \Illuminate\Http\Response
   */
  public function edit(int $id): \Illuminate\View\View {
    return view(self::CRUD_VIEWS . 'edit', [
      'title' => $this->titles()['edit'] ?? '',
      'buttons' => static::LIVEWIER_CLASS::editButtons(),
      'fields' => static::LIVEWIER_CLASS::editFields(),
      'route' => route(static::ROUTE_NAME . 'update', $id),
      'validationRules' => static::MODEL_CLASS::validationRules(),
      'data' => static::MODEL_CLASS::find($id),
    ]);
  }

  /**
   * Updates an existing record identified by its ID.
   *
   * @param \Illuminate\Http\Request $request The request object containing data.
   * @param int $id The ID of the record to update.
   * @return \Illuminate\Http\RedirectResponse Redirects back to the edit form.
   */
  public function update(Request $request, int $id) {
    $record = static::MODEL_CLASS::find($id);

    if($record) {
      $this->beforeValidation($request);
      $validate = $request->validate(static::MODEL_CLASS::validationRules($id));
      $this->afterValidation($request);
      $this->beforeUpdate($validate, $record);
      $record->update($validate);
      $this->afterUpdate($record);
      return redirect()->route(static::ROUTE_NAME . 'index')
        ->with('success', $this->titles()['recordUpdateSucces'] 
        ?? 'Record has been updated');
    }

    return redirect()->route(static::ROUTE_NAME . 'index')
      ->with('error', $this->titles()['recordNotFound'] ?? 'Record not found');
  }

  /**
   * Deletes a model record by ID.
   *
   * @param  int  $id  The ID of the record to delete.
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(int $id) {
    $record = static::MODEL_CLASS::find($id);

    if($record) {
      $this->beforeDestroy($record);
      $this->afterDestroy($record->delete());
      return redirect()->route(static::ROUTE_NAME . 'index')
        ->with('success', $this->titles()['recordDestroySucces'] 
        ?? 'Record has been deleted');
    }

    return redirect()->route(static::ROUTE_NAME . 'index')
      ->with('error', $this->titles()['recordNotFound'] ?? 'Record not found');
  }

}