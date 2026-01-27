<?php

declare(strict_types=1);

namespace Ulp\Core\Traits;

use Ulp\Core\View\FormFields\DateTime\DateTimeTypeControl;
use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ulp\Core\View\FormFields\Components\TextInput;


trait DefaultController {

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
  protected const ROUTE_NAME = null;

  /**
   * Return an array of form fields used in the create show edit views.
   *
   * @return array List of fields elements for the given controller.
   */
  abstract protected function formFields(): array;

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
   * Returns an instance of the model defined in the child controller.
   *
   * @return \Illuminate\Database\Eloquent\Model
   */
  protected function getModelInstance(): \Illuminate\Database\Eloquent\Model {
    return app(static::MODEL_CLASS);
  }

  protected function resolveFormContext() {
    return match (Route::currentRouteName()) {
      static::ROUTE_NAME.'create' => 'create',
      static::ROUTE_NAME.'edit'   => 'edit',
      static::ROUTE_NAME.'show'   => 'show',
    };
  }

  /**
   * Prepares widowed crud form elements based on their specific fields, 
   * depending on the controller used.
   * 
   * @return array List of used fields
   */
  protected function prepareFormFields($data = null): array {
    $currentRoute = Route::currentRouteName();
    return [
      'fields' => $this->formFields(),
      'buttons' => [
        ...$this->formFieldsButtons($currentRoute),
        ButtonsTypeController::make([
          'type' => 'anchore',
          'routeName' => static::ROUTE_NAME . 'index',
          'label' => 'Return',
          'icone' => 'fa-solid fa-arrow-left',
        ]),
      ],
    ];
  }

  // Preper submit button for crud operations
  protected function formFieldsButtons($currentRoute) {
    return $currentRoute !== static::ROUTE_NAME . 'create' ? [
      ButtonsTypeController::make([
        'type' => 'submit',
        'label' => 'Save',
        'icone' => 'fa-solid fa-file',
      ])
    ] : [];
  }

  // Preper id field for crude operations
  protected function getIdField() {
    return TextInput::make('id')->label('Id')->numeric();
  }

  // Preper time stamps fields for crude operations
  protected function getTimestampFields($created_at, $updated_at, $currentRoute): array {
    return $currentRoute !== static::ROUTE_NAME . 'create' ? [
      DateTimeTypeControl::make([
        'type' => 'datetime-local',
        'name' => 'created_at',
        'label' => 'Utworzony',
        'readonly' => true,
        'value' => $created_at,
      ]),
      DateTimeTypeControl::make([
        'type' => 'datetime-local',
        'name' => 'updated_at',
        'label' => 'Zaktualizowany',
        'readonly' => true,
        'value' => $updated_at,
      ])
    ] : [];
  }

  // Prepare buttobs for index vievs
  protected function prepareIndexButtons(): array {
    return Route::has(static::ROUTE_NAME . 'create') ? [
      ButtonsTypeController::make([
        'type' => 'anchore',
        'routeName' => static::ROUTE_NAME . 'create',
        'label' => $this->titles()['recordAddButton'] ?? 'Add',
        'icone' => 'fa-solid fa-plus',
      ]),
    ] : [];
  }

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
      'buttons' => $this->prepareIndexButtons(),
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
      'controls' => $this->prepareFormFields(),
      'route' => route(static::ROUTE_NAME . 'store'),
      'validationRules' => static::MODEL_CLASS::validationRules(),
    ]);
  }

  /**
   * Handles storing a new record.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request) {
    $validate =  $request->validate(static::MODEL_CLASS::validationRules());       
    $this->callHook('beforeStore', $validate);
    $this->callHook('afterStore', $validate, static::MODEL_CLASS::create($validate));
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
      'controls' => $this->prepareFormFields(static::MODEL_CLASS::find($id)),
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
      'route' => route(static::ROUTE_NAME . 'update', $id),
      'controls' => $this->prepareFormFields(static::MODEL_CLASS::find($id)),
      'validationRules' => static::MODEL_CLASS::validationRules(),
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
      $validate = $request->validate(static::MODEL_CLASS::validationRules($id));
      $this->callHook('beforeUpdate', $validate, $record);
      $record->update($validate);
      $this->callHook('afterUpdate', $validate, $record);
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
      $this->callHook('beforeDestroy', $record);
      $this->callHook('afterDestroy', $record->delete());
      return redirect()->route(static::ROUTE_NAME . 'index')
        ->with('success', $this->titles()['recordDestroySucces'] 
        ?? 'Record has been deleted');
    }

    return redirect()->route(static::ROUTE_NAME . 'index')
      ->with('error', $this->titles()['recordNotFound'] ?? 'Record not found');
  }

  /**
   * This method checks whether a method with the given hook name exists in the 
   * current class. If it does, it will be executed with the provided parameters.
   *
   * @param string $hook   The name of the hook/method to call.
   * @param mixed  ...$params  Optional parameters to pass to the hook method.
   * @return void
   */
  protected function callHook(string $hook, ...$params): void {
    if (method_exists($this, $hook)) {
      $this->$hook(...$params);
    }
  }

}